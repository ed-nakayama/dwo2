<?php

namespace App\Http\Controllers\Classes;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Classes\Util;
use App\Models\AgentView;
use App\Models\ProfileMt;
use App\Models\User;
use App\Models\MCcCust;

class CustDAO {

	public $util;
/*
 * コンストラクタ
 */
	function __construct() {
		// 初期化
		$this->util = new Util();
	}


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/cust/custList.php findNew()
 ***************************************************************/
    public function findNew($userId) {

		$cust = AgentView::leftjoin('DWO_PROFILE_MT' ,'CUST_NUM' ,'PROFILE_CUST_CODE')
			->whereNull('PROFILE_CUST_CODE')
			->distinct()
			->selectRaw('cust_num, mail_address')
			->get();

		if (isset($cust[0])) {
			$prof = User::create([
				'profile_cust_code'       => $cust[0]->cust_num,
				'email'                   => $cust[0]->mail_address,
				'profile_comment'         => '新規作成',
				'profile_modified_id'     => $userId,
				'profile_del'             => '0',
			]);
		}

        return;
    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   weborder/top/TopHome.php index()
 ***************************************************************/
    public function find_by_id($cust_num){

		$cust = MCcCust::where('cust_num', $cust_num)
			->where('del_type', '0')
			->first();

		return $cust;
    }


 /*************************************************************
 * 条件検索
 *
 * 利用ファイル
 *   admin/cust/custList.php findList()
 *   admin/cust/custDetail.php find()
 *   admin/Order/OrderDelivery.php search()
 ***************************************************************/
    public function find($param) {

		$userList = User::join('agent_view', 'DWO_profile_mt.profile_cust_code' ,'agent_view.cust_num')
			->join('m_support', function ($join)  {
                $join->on('agent_view.account_num','=','m_support.account_num')
					->whereRaw('agent_view.support_seq_num = m_support.seq_num')
					->where('m_support.del_type', '0');
			})
			->selectRaw('DWO_profile_mt.*, ' .
				' agent_view.cust_num, agent_view.name1, agent_view.name2, agent_view.search_name, agent_view.search_name_kana, ' . 
				' agent_view.post, agent_view.address1, agent_view.address2, agent_view.address3,' .
				' agent_view.tel, agent_view.search_tel, agent_view.fax, agent_view.search_fax,' .
				' agent_view.close_date1, agent_view.pay_cycle1, agent_view.pay_date1, agent_view.credit_limit, agent_view.tran_status_type,   ' . 
				' agent_view.cust_class_large, agent_view.cust_class_medium, agent_view.cust_class_small, '.
				' agent_view.class_large_name,   agent_view.class_medium_name, agent_view.class_small_name,' .
				' agent_view.account_num, agent_view.support_seq_num,' . 
				' agent_view.contact_department, agent_view.contact_title, agent_view.contact_name1, agent_view.mail_address, agent_view.pref_cd,' . 
				' agent_view.pap_treat_type, agent_view.pref, agent_view.cust_group1, agent_view.cust_group2,' . 
				' M_SUPPORT.start_date, M_SUPPORT.end_date'
			);

		if (isset($param['search_cust_code'])) {
        	$userList = $userList->where('agent_view.cust_num' ,$param['search_cust_code']);
        }

		if (isset($param['search_account_num'])) {
        	$userList = $userList->where('agent_view.account_num' ,$param['search_account_num']);
        }

		if (isset($param['search_tel'])) {
        	$userList = $userList->where('agent_view.search_tel' ,$param['search_tel']);
        }

		if (isset($param['search_name'])) {
        	$userList = $userList->where('agent_view.name1', 'like' ,'%' . $param['search_name'] . '%');
        }

		if (isset($param['search_name_kana'])) {
        	$userList = $userList->where('agent_view.search_name_kana', 'like' ,'%' . $param['search_name_kana'] . '%');
        }

		if (!empty($param['search_web_flag'])) {
        	$userList = $userList->where('DWO_profile_mt.profile_web_flag', $param['search_web_flag'] );
        }

		if (!empty($param['search_del_flag'])) {
        	$userList = $userList->where('DWO_profile_mt.profile_del', $param['search_del_flag'] );
        }

		$userList = $userList->paginate(20);

/*
		// 与信残額の取得
		if ($cust->custCode != "") {
			require_once 'CreditInfoManager.class.php';
			$creditinfomanager = new CreditInfoManager();
			$creditinfo = $creditinfomanager->GetCreditDataByCustCode($cust->custCode);
			$cust->limitPrice = $creditinfo->credit_limit;
			$cust->salesPrice = $creditinfo->credit_limit - $creditinfo->credit_balance;
			$cust->zanPrice = $creditinfo->now_temp_order_sum;
			$cust->restPrice = $creditinfo->yuyo;
		}
*/
//        return $pagination;
        return $userList;

    }


 /*************************************************************
 * 更新
 *
 * 利用ファイル
 *   admin/cust/custDetail.php detail_update()
 ***************************************************************/
    public function update($userId, $param) {

		$cust = ProfileMt::where('profile_cust_code' ,$param['cust_code'])
			->first();

		$mail_flag       = (!empty($param['mail_flag']))       ? '1' : '0';
		$extra_mail      = (isset($param['extra_mail']))      ? $param['extra_mail'] : null;
		$extra_mail_flag = (!empty($param['extra_mail_flag'])) ? '1' : '0';
		$web_flag        = (!empty($param['web_flag']))        ? '1' : '0';
		$comment         = (isset($param['comment']))         ? $param['comment'] : null;
		$profile_del     = (!empty($param['del_flag']))        ? '1' : '0';

		if ( $cust->profile_mail_flag         != $mail_flag 
			|| $cust->profile_extra_mail      != $extra_mail
			|| $cust->profile_extra_mail_flag != $extra_mail_flag
			|| $cust->profile_web_flag        != $web_flag
			|| $cust->profile_comment         != $comment
			|| $cust->profile_del             != $profile_del)
		{
			$cust->profile_modified_id = $userId;
		}

		$cust->profile_mail_flag        = $mail_flag;
		$cust->profile_extra_mail       = $extra_mail;
		$cust->profile_extra_mail_flag  = $extra_mail_flag;
		$cust->profile_web_flag         = $web_flag;
		$cust->profile_comment          = $comment;
		$cust->profile_del              = $profile_del;


		$cust->save();

        return;

    }

}
