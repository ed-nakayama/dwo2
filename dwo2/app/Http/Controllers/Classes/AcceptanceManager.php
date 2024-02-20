<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Mail;

use App\Models\AgentView;

use App\Mail\CancelResult;
use App\Mail\DemandResult;
use App\Mail\DemandMail;


define("ONEDAY", 60*60*24); // 1日

class AcceptanceManager {

	private $l_time;       // 現在時刻
	private $callAction;   // 呼び出しアクション

	private $cancelDay;    // 承認期限切れ日数
	private $cancelEnable; // 承認期限切れバッチ実行可否
	private $demandDay;    // 承認督促日数
	private $demandEnable; // 承認督促バッチ実行可否

	public $nightBatch;    // バッチ実行 // 夜間バッチ実行を指定(全てbatch_confテーブル定義どおりに動作する)


	/*
	 * コンストラクタ
	 * 引数: 呼び出しクラス
	 */
	function __construct($paramAction) {
		$this->l_time = time();
		$this->callAction = $paramAction;
		$nightBatch = FALSE;
	}

/************************************************
* batch_confテーブル検索
 ************************************************/
	function SearchBatchConf() {
		$batchconfdao = new BatchConfDAO();
		$batchconf = $batchconfdao->find();

		$this->cancelDay    = $batchconf->cancelDay   ; // 承認期限切れ日数
		$this->cancelEnable = $batchconf->cancelEnable; // 承認期限切れバッチ実行可否
		$this->demandDay    = $batchconf->demandDay   ; // 承認督促日数
		$this->demandEnable = $batchconf->demandEnable; // 承認督促バッチ実行可否
	}


/************************************************
 * 承認期限切れ注文取り消し処理
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
		// T_WEB_ORDER_HDRオブジェクト作成
		$webOrderHeaderDAO = new WebOrderHeaderDAO();

		// Acceptanceテーブルの該当リストを検索取得
		$orderAcceptanceDAO = new OrderAcceptanceDAO();
		$cancelList = $orderAcceptanceDAO->findForCancelList();

		$cancelChkDate = date("Y-m-d", $this->l_time - ONEDAY*$cancelDay);
		$canceledArray = array();

		foreach ($cancelList as $can) {
			$regDate = $can->order_acceptance_order_date; // 注文日の取得

			if ($regDate <= $cancelChkDate) {
				// DWO_ORDER_ACCEPTANCE処理
				$can->order_acceptance_flag = "3"; // 期限切れ
				$orderAcceptanceDAO->update($can); // テーブル更新
				// T_WEB_ORDER_HDR処理
				$webOrderHeaderDAO->updateStatusForBatch($can->order_acceptance_header_no);  // 期限切れ専用
				$canceledArray[] = $can->order_acceptance_header_no;
			}
		}

		$this->cancelResultMail($canceledArray);

		return 0;
	}


/************************************************
 * 承認督促メール送信
 *
 * 利用ファイル
 *   admin/batch/BatchConf.php store()
 ************************************************/
	function Demand($demandDay=0, $demandEnable=0) {

/* バッチでは使わない
		if ($this->nightBatch == TRUE) {
			// batch_confテーブル検索
			$this->SearchBatchConf();
			$demandDay    = $this->demandDay;
			$demandEnable = $this->demandEnable;
		}

		if ($demandEnable == "") {
			return 0;
		}
		if ($demandEnable == 0) {
			return 0;
		}
*/

		// Acceptanceテーブルの該当リストを検索取得
		$orderAcceptanceDAO = new OrderAcceptanceDAO();
		$demandList = $orderAcceptanceDAO->findForDemandList();

		$demandChkDay = date("Y-m-d", $this->l_time - ONEDAY*$demandDay);
		$demandedArray = array();

		foreach ($demandList as $demand) {
			$regDate = $demand->order_acceptance_order_date; // 注文日の取得

			if ($regDate <= $demandChkDay) {
				$orderAcceptanceDAO->updateDemandDate($demand->order_acceptance_header_no);
				$this->demandMail($demand);
				$demandedArray[] = $demand->order_acceptance_header_no;
			}
		}

		$this->demandResultMail($demandedArray);

		return 0;
	}


/*******************************************
 * 督促メール送信
 *******************************************/
	function demandMail($orderacceptance) {

		// WEB受注基本テーブル検索
		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$weborderheader = $webOrderHeaderDAO->find($orderacceptance->order_acceptance_header_no);

		// WEB受注詳細テーブル検索
		$webOrderDetailDAO = new WebOrderDetailDAO();
		$weborderdetailList = $webOrderDetailDAO->findNamePlus($orderacceptance->order_acceptance_header_no);

		// 顧客情報検索
		$agentviewDAO = new AgentViewDAO();
		$agentview = $agentviewDAO->findById($orderacceptance->order_acceptance_cust_code);


		// DWO得意先設定情報
		$profileDAO = new ProfileDAO();
    	$profile = $profileDAO->findWeb($agentview->cust_num);

		$mailTo = array();

		if ( ($profile->profile_mail_flag == '1') && !empty($agentview->mail_address) ) {
			$mailTo[] = $agentview->mail_address;
		}

		if ( ($profile->profile_extra_mail_flag == '1') && !empty( $profile->profile_extra_mail) ) {
			$mailTo[] = $profile->profile_extra_mail;
		}
		if ($mailTo) {
			Mail::send(new DemandMail($mailTo, $agentview, $orderacceptance, $weborderheader, $weborderdetailList) );
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
