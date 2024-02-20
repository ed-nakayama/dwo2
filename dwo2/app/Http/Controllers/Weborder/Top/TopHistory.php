<?php

namespace App\Http\Controllers\Weborder\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\WebOrderDetailDAO;
use App\Http\Controllers\Classes\OrderAcceptanceDAO;
use App\Http\Controllers\Classes\CalendarMtDAO;

use App\Mail\Syonin;

class TopHistory extends Controller
{

/*************************************
* 注文履歴
**************************************/
	public function index()
	{
		return view('weborder.top.history2');
	}


 /*************************************************************
 * 検索
 *************************************************************/
    function search(Request $request)
    {
		$validated = $request->validate([
			'frm_from_date'             => ['nullable', 'date_format:Y-m-d'],
			'frm_to_date'               => ['nullable', 'date_format:Y-m-d'],
			'frm_web_order_num'         => ['nullable'],
			'frm_item_cd'               => ['nullable'],
			'frm_dwo_order_person_name' => ['nullable'],
			'frm_direct_delivery_type'  => ['nullable'],
			'frm_dest_name1'            => ['nullable'],
			'frm_state_type'            => ['nullable'],
		]);

		$agentView = session('agentView');

		$OldestDate = date("Y-m-d",strtotime("-6 month"));

		// オーダー詳細を検索
		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$orderList = $webOrderHeaderDAO->findHistory2($agentView->cust_num ,$OldestDate ,$validated);

		return view('weborder.top.history2search',
			[
			'orderList'                 => $orderList,
			'frm_from_date'             => $request->input('frm_from_date'),
			'frm_to_date'               => $request->input('frm_to_date'),
			'frm_web_order_num'         => $request->input('frm_web_order_num'),
			'frm_item_cd'               => $request->input('frm_item_cd'),
			'frm_dwo_order_person_name' => $request->input('frm_dwo_order_person_name'),
			'frm_direct_delivery_type'  => $request->input('frm_direct_delivery_type'),
			'frm_dest_name1'            => $request->input('frm_dest_name1'),
			'frm_state_type'            => $request->input('frm_state_type'),
			]);
    }


 /*************************************************************
 * 詳細
 *************************************************************/
    function detail(Request $request)
    {
		$param = $request->only(
			'frm_order_num',
			'frm_from_date',
			'frm_to_date',
			'frm_web_order_num',
			'frm_item_cd',
			'frm_dwo_order_person_name',
			'frm_direct_delivery_type',
			'frm_dest_name1',
			'frm_state_type',
		);

		$orderNum = $request->input('frm_order_num');

		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$weborderHeader = $webOrderHeaderDAO ->find2($orderNum);

		$webOrderDetailDAO = new WebOrderDetailDAO();
		$weborderdetailList = $webOrderDetailDAO->findNamePlus2($orderNum);

		// 削除可能かどうか 受付中、承認待ち、予約受付中、予約承認待ちの4ケース
		if (	($weborderHeader->state_type == "0") || ($weborderHeader->state_type == "4") ||
				($weborderHeader->state_type == "8") || ($weborderHeader->state_type == "9")
			) {	
			$weborderHeader->delete_ok = "1";
		} else {
			$weborderHeader->delete_ok = "0"; // テンプレ用にフラグを立てる
		}

		return view('weborder.top.history2detail',
			[
			'orderheader'               => $weborderHeader,
			'orderdetailList'           => $weborderdetailList,
//			'page'                      => $request->input('page'),
			'frm_from_date'             => $request->input('frm_from_date'),
			'frm_to_date'               => $request->input('frm_to_date'),
			'frm_web_order_num'         => $request->input('frm_web_order_num'),
			'frm_item_cd'               => $request->input('frm_item_cd'),
			'frm_dwo_order_person_name' => $request->input('frm_dwo_order_person_name'),
			'frm_direct_delivery_type'  => $request->input('frm_direct_delivery_type'),
			'frm_dest_name1'            => $request->input('frm_dest_name1'),
			'frm_state_type'            => $request->input('frm_state_type'),
			]);
    }


 /*************************************************************
 * 削除
 *************************************************************/
    function delete(Request $request)
    {
		// オーダー削除処理
		$order_num = $request->input('del_order_num');

		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$webOrderHeaderDAO->deleteOrder($order_num);


		return redirect()->route('top.history.search', 
			[
			'frm_from_date'             => $request->input('frm_from_date'),
			'frm_to_date'               => $request->input('frm_to_date'),
			'frm_web_order_num'         => $request->input('frm_web_order_num'),
			'frm_item_cd'               => $request->input('frm_item_cd'),
			'frm_dwo_order_person_name' => $request->input('frm_dwo_order_person_name'),
			'frm_direct_delivery_type'  => $request->input('frm_direct_delivery_type'),
			'frm_dest_name1'            => $request->input('frm_dest_name1'),
			'frm_state_type'            => $request->input('frm_state_type'),
			]);
    }


 /*************************************************************
 * メール変更
 *************************************************************/
    function mail_change(Request $request)
    {
		$validated = $request->validate([
			'chg_order_num' => ['required'],
		]);

		return view('weborder.top.historymailchg', 
			[
			'chg_order_num' => $request->input('chg_order_num'),
			'old_mail_addr' => $request->input('old_mail_addr'),
			]);
    }


 /*************************************************************
 * メール変更 確認
 *************************************************************/
    function mail_confirm(Request $request)
    {
		$validated = $request->validate([
			'chg_order_num' => ['required'],
			'new_mail_addr' => ['required', 'email' ,'confirmed'],
		]);


		return view('weborder.top.historymailconfirm' ,
			[
			'chg_order_num' => $request->input('chg_order_num'),
			'old_mail_addr' => $request->input('old_mail_addr'),
			'new_mail_addr' => $request->input('new_mail_addr'),
		]);

    }


 /*************************************************************
 * メール変更 実行
 *************************************************************/
    function mail_do(Request $request)
    {
		$orderNum = $request->input('chg_order_num');
		$newMailAddr = $request->input('new_mail_addr');
		$oldMailAddr = $request->input('old_mail_addr');

		$webOrderHeaderDAO = new WebOrderHeaderDAO();

		// メールアドレス更新処理
		$webOrderHeaderDAO->updateMailAddress($orderNum, $oldMailAddr, $newMailAddr);

		// 承認用テーブル
		$orderAcceptanceDAO = new OrderAcceptanceDAO();
		$orderacceptance = $orderAcceptanceDAO->findOrderNum($orderNum);

		// WEB受注基本
		$weborderheader = $webOrderHeaderDAO->find($orderNum);

		// 得意先情報取得
		$agentView = session('agentView');

		// WEB受注詳細
		$webOrderDetailDAO = new WebOrderDetailDAO();
		$weborderdetailList = $webOrderDetailDAO->findNamePlus($orderNum);

		// 値編集処理
		if ($orderacceptance) { // 通常の場合
			$order_date = $orderacceptance->order_acceptance_order_date;
			$year = substr($order_date ,0 ,4);
			$mon = substr($order_date ,5 ,2);
			$day = substr($order_date ,8 ,2);
			$date_today = mktime (0, 0, 0, $mon, $day,  $year);
			$tmpdate = $date_today + 86400*14; //  // 2週間後の日付
			$ago2week = date('Y-m-d', $tmpdate);
			$upgrade_flag = "0"; // アップグレードフラグ

		} else { // upgrade の場合
			$calendarMtDAO = new CalendarMtDAO();
			$cancelDay = $calendarMtDAO->dayFromLastDay(1);
			$ago2week = date("Y-m-") . sprintf('%02d', $cancelDay);  // 最終営業日前日
			$upgrade_flag = "1"; // アップグレードフラグ
		}

		$mailTo = $weborderheader->mail_address;

		// メール送信処理 ==========================================================================
		 Mail::send(new Syonin($agentView, $weborderheader, $weborderdetailList, $orderacceptance, $ago2week, $upgrade_flag, $mailTo ));

		return redirect()->route('top.history.detail', 
			[
			'frm_order_num' => $request->input('chg_order_num'),
			])
			->with('status', 'success-store');

    }

}
