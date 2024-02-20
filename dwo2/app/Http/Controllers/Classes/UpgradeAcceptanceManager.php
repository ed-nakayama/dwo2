<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Mail;

use App\Models\AgentView;

use App\Mail\CancelResult;
use App\Mail\DemandResult;
use App\Mail\DemandMail;
use App\Mail\DemandUpgrade;

if (!defined('ONEDAY')) {
	define("ONEDAY", 60*60*24); // 1日
}

class UpgradeAcceptanceManager {

	private $l_time;       // 現在時刻
	private $callAction;   // 呼び出しアクション

	private $cancelDay;    // 承認期限切れ日数
	private $cancelEnable; // 承認期限切れバッチ実行可否
	private $demandDay;    // 承認督促日数
	private $demandEnable; // 承認督促バッチ実行可否
	private $logger;
	
	public $nightBatch;    // バッチ実行 // 夜間バッチ実行を指定(全てbatch_confテーブル定義どおりに動作する)


	/*
	 * コンストラクタ
	 * 引数: 呼び出しクラス
	 */
	function __construct($paramAction) {

		//$ctl =& Ethna_Controller::getInstance();
		//$this->logger = $ctl->getLogger();
		$this->l_time = time();
		$this->callAction = $paramAction;
		$nightBatch = FALSE;
//		$this->logger =& $this->callAction->backend->getLogger();

	}

	// batch_confテーブル検索
	function SearchBatchConf() {
		$batchconfdao = new BatchConfDAO();
		$batchconf = $batchconfdao->find();

		$this->cancelDay    = $batchconf->upgradeCancelDay   ; // 承認期限切れ日数
		$this->cancelEnable = $batchconf->upgradeCancelEnable; // 承認期限切れバッチ実行可否
		$this->demandDay    = $batchconf->upgradeDemandDay   ; // 承認督促日数
		$this->demandEnable = $batchconf->upgradeDemandEnable; // 承認督促バッチ実行可否
	}


/************************************************
 * アップグレード承認期限切れ注文取り消し処理
 *
 * 利用ファイル
 *   admin/batch/BatchConf.php store()
 ************************************************/
	function Cancel($cancelDay=0, $cancelEnable=0) {

/* バッチでは使わない
		if ($this->nightBatch == TRUE) {
			// batch_confテーブル検索
			$this->SearchBatchConf();
			$cancelDay    = $this->cancelDay;
			$cancelEnable = $this->cancelEnable;
		}

		if ($cancelEnable == "") {
			return 0;
		}
		if ($cancelEnable == 0) {
			return 0;
		}
*/

		$calendarMtDAO = new CalendarMtDAO();
		$cancelDay = $calendarMtDAO->dayFromLastDay($cancelDay);

		if (date("d") == $cancelDay) { // 15:00で実行

			// T_WEB_ORDER_HDRオブジェクト作成
			$webOrderHeaderDAO = new WebOrderHeaderDAO();

			// Acceptanceテーブルの該当リストを検索取得
			$orderAcceptanceUpgradeDAO = new OrderAcceptanceUpgradeDAO();
			$cancelList = $orderAcceptanceUpgradeDAO->findForCancelList();

			$cancelChkDate = date("Y-m-d", $this->l_time - ONEDAY*$cancelDay);
			$canceledArray = array();

			foreach ($cancelList as $can) {
				// DWO_ORDER_ACCEPTANCE処理
				$can->order_acceptance_flag = "3"; // 期限切れ
				$orderAcceptanceUpgradeDAO->update($can); // テーブル更新
				// T_WEB_ORDER_HDR処理
				$webOrderHeaderDAO->updateStatusForBatch($can->order_acceptance_header_no);  // 期限切れ専用
				$canceledArray[] = $can->order_acceptance_header_no;
			}

			$this->cancelResultMail($canceledArray);
		}

		return 0;
	}


/************************************************
 * アップグレード承認督促メール送信
 * 利用ファイル
 *   admin/batch/BatchConf.php store()
 ************************************************/
	function Demand($demandDay=0, $demandEnable=0) {

		$cancelDay = 0;

/* バッチでは使わない
		if ($this->nightBatch == TRUE) {
			// batch_confテーブル検索
			$this->SearchBatchConf();
			$demandDay    = $this->demandDay;
			$demandEnable = $this->demandEnable;
			$cancelDay    = $this->cancelDay;
		}

		if ($demandEnable == "") {
			return 0;
		}

		if ($demandEnable == 0) {
			return 0;
		}
*/

		$calendarMtDAO = new CalendarMtDAO();
		$demandDay = $calendarMtDAO->dayFromLastDay($demandDay);
		$cancelDay = $calendarMtDAO->dayFromLastDay($cancelDay);

//		if (date("d") == $demandDay) {
		if ('27' == $demandDay) {
		
			// Acceptanceテーブルの該当リストを検索取得
			$orderAcceptanceUpgradeDAO = new OrderAcceptanceUpgradeDAO();
			$demandList = $orderAcceptanceUpgradeDAO->findForDemandList();
//dd($demandList);
			$demandedArray = array();

			foreach ($demandList as $demand) {

				$demand->order_date2w_ago = date("Y-m-") . $cancelDay;

				$orderAcceptanceUpgradeDAO->updateDemandDate($demand->order_acceptance_header_no);
				$this->demandMail($demand);
				$demandedArray[] = $demand->order_acceptance_header_no;
			}
			$this->demandResultMail($demandedArray);

		}

		return 0;
	}


/*******************************************
 * 督促メール送信
 *******************************************/
	function demandMail($orderacceptance) {

		// WEB受注基本テーブル検索
		$weborderheaderdao = new WebOrderHeaderDAO();
		$weborderheader = $weborderheaderdao->find($orderacceptance->order_acceptance_header_no);

		// WEB受注詳細テーブル検索
		$weborderdetaildao = new WebOrderDetailDAO();
		$weborderdetailList = $weborderdetaildao->findNamePlus($orderacceptance->order_acceptance_header_no);

		// 顧客情報検索
		$agentviewDAO = new AgentViewDAO();
		$agentView = $agentviewDAO->findById($orderacceptance->order_acceptance_cust_code);


		// DWO得意先設定情報
		$profileDAO = new ProfileDAO();
    	$profile = $profileDAO->findWeb($agentView->cust_num);

		$mailTo = array();

		if ($profile->profile_mail_flag) {
			$mailTo[] = $agentView->mail_address;
		}

		if ($profile->profile_extra_mail_flag) {
			$mailTo[] = $profile->profile_extra_mail;
		}

		if ($mailTo) {
			Mail::send(new DemandUpgrade($mailTo, $agentView, $orderacceptance, $weborderheader, $weborderdetailList) );
		}


	}


/*******************************************
 * キャンセル結果メール
 *******************************************/
	function cancelResultMail($orderNoList) {

		 Mail::send(new CancelResult($orderNoList ));
	}


/*******************************************
 * 承認督促メール結果メール
 *******************************************/
	function demandResultMail($orderNoList) {

		 Mail::send(new DemandResult($orderNoList ));
	}

}
