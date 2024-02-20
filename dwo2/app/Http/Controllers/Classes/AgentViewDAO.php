<?php

namespace App\Http\Controllers\Classes;

use App\Models\AgentView;

class AgentViewDAO {
	
	const CUST_CLASS_OR = 'OR';
	const CUST_CLASS_PAP_GOLD = 'GOLD';
	const CUST_CLASS_PAP_MEMBER = 'PAP';
	const CUST_CLASS_YBP = 'YBP';

	public $pap_only = FALSE; // PAPのみ検索する場合はTRUE
	
 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/order/OrderListDetail.php detail()
 *   admin/order/OrderList2Detail.php detail()
 *   admin/order/OrderList2Detail.php store()
 *   weborder/top/TopHome.php index()
 *   weborder/order/OrderPrintview.php viewer()
 *   weborder/order/OrderUpgradeprint.php viewer()
 *   classes/AcceptanceManager.php demandMail()
 *   classes/UpgradeAcceptanceManager.php demandMail()
 *   Requests/Auth/LoginRequest.php userCheck()
 ***************************************************************/
	public function findById($custNum) {

		$agentView = AgentView::where('cust_num', $custNum)
			->selectRaw(
			' cust_num, name1, name2, search_name, search_name_kana, mail_address,' . 
			' post, pref_cd, pref, address1, address2, address3,' .
			' tel, search_tel, fax, search_fax,' .
			' close_date1, pay_cycle1, pay_date1, credit_limit, tran_status_type,   ' . 
			' cust_class_large, cust_class_medium, cust_class_small, class_large_name, class_medium_name, class_small_name,' .
			' account_num, support_seq_num,' . 
			' contact_department, contact_title, contact_name1,' . 
			' pap_treat_type, cust_group1, cust_group2');

		if ($this->pap_only) {
			$agentView = $agent->where('cust_class_medium', '01');
		}

		$agentView = $agentView->first();

		if (!empty($agentView)) {
			$agentView->cust_class_code = $this->GetCustClassCode($agentView);
		}
		return $agentView;

	}

 /*****************************************
 * 顧客区分論理コードを取得します。<br />
 * <li>OR      : オリコンまたはティーエム情報</li>
 * <li>GOLD    : PAPゴールド</li>
 * <li>PAP     : PAPメンバー</li>
 * <li>YBP     : YBP</li>
 * @return string 顧客区分論理コード
 ******************************************/
	private function getCustClassCode($agent) {

		if (($agent->cust_num == config('dwo.DWO_ORICON_ID')) || ($agent->cust_num == config('dwo.DWO_TM_ID'))) {
			return self::CUST_CLASS_OR;
		}

		if ($agent->cust_class_medium == '01') {

			if ($agent->cust_class_medium == '01') {
				return self::CUST_CLASS_PAP_GOLD;
			} else {
				return self::CUST_CLASS_PAP_MEMBER;
			}

		} else if ($agent->cust_class_medium == '02') {

			return self::CUST_CLASS_YBP;

		}

		return "";

	}


}
