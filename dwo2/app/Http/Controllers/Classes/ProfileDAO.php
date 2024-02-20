<?php

namespace App\Http\Controllers\Classes;

use App\Models\ProfileMt;

class ProfileDAO {

 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/order/OrderList2Detail.php store()
 ***************************************************************/
    public function find($custNum) {

		$profile = ProfileMt::find($custNum);

        return $profile;
    }


 /*************************************************************
 * 条件検索 WEB用
 *
 * 利用ファイル
 *   classes/AcceptanceManager.php demandMail()
 *   classes/UpgradeAcceptanceManager.php demandMail()
 ***************************************************************/
    public function findWeb($custNum) {

		$profile = ProfileMt::where('profile_cust_code' ,$custNum)
			->where('profile_del', '0')
			->first();

        return $profile;
    }


 /*************************************************************
 * パスワード忘れ
 *
 * 利用ファイル
 *   weborder/Forgetchk.php chk_profile()
 ***************************************************************/
    public function findForForget($id, $tel, $mail) {

		$query = ProfileMt::join('agent_view','dwo_profile_mt.profile_cust_code','agent_view.cust_num')
			->selectRaw('dwo_profile_mt.profile_cust_code, (agent_view.name1 || agent_view.name2) as cname')
			->where('dwo_profile_mt.profile_web_flag' ,'1')
			->where('agent_view.mail_address', $mail);
			
		if (!empty($id)) {
	        $query = $query->where('dwo_profile_mt.profile_cust_code', $id);
		}
		if (!empty($tel)) {
	        $query = $query->where('agent_view.tel', $tel);
		}

		$datary = $query->first();

        return $datary;
    }


}
