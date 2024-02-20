<?php

namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Classes\AgentViewDAO;
use App\Http\Controllers\Classes\CustDAO;
use App\Http\Controllers\Classes\DisagentDAO;
use App\Http\Controllers\Classes\OrderInfoSession;
use App\Http\Controllers\Classes\BasketSession;
use App\Http\Controllers\Classes\CreditInfoManager;


class TopHome extends Controller
{

/*************************************
* mypage
**************************************/
	public function index(Request $request)
	{
		$user = Auth::user();

		$agentView = session('agentView');

		// PAPの場合、専用画面に遷移（2017/10/03 PAPサンセット）
		if ($agentView->cust_class_code != "OR" && $agentView->cust_class_code != "YBP") {
        	$request->session()->invalidate();
        	$request->session()->regenerateToken();

			return view('weborder.serviceinfo');
		}

		$orderinfosession = new OrderInfoSession();

		if (empty($orderinfosession->orderinfolist)) {
			$orderinfosession->clear();
			$orderinfo = $orderinfosession->get();

			$orderinfo->cust_kbn = $agentView->cust_class_code;

			$custdao = new CustDAO();
			$papinfo = $custdao->find_by_id($user->profile_cust_code);

			$mdisagentDAO = new DisagentDAO();
			$disagent_upgrade = $mdisagentDAO->isDisable(1,$papinfo->cust_group2);

			$orderinfo->disable_upgrade = $disagent_upgrade;

			// セッションに情報をセットし次のページへ
			$orderinfosession->set($orderinfo);

			$orderinfo->disable_upgrade = $disagent_upgrade;
			$orderinfo->pap_order = true;
			$orderinfosession->set($orderinfo);

			$basketsession = new BasketSession();
			$basketsession->clear();

		} else {
			$orderinfo = $orderinfosession->get();
		}

		
		// 通常製品セット
		$orderinfo->pap_order = FALSE;
		$orderinfo->upgrade_order = FALSE;
		$orderinfosession->set($orderinfo);

		// 与信データ取得(再セット)
		$creditinfomanager = new CreditInfoManager();
		$creditinfo = $creditinfomanager->GetCreditData($user->profile_cust_code);

		return view('weborder.top.home',compact(
			'orderinfo',
		));
	
	}


}
