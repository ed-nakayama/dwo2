<?php

namespace App\Http\Controllers\Weborder\Recognize;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Classes\OrderAcceptanceDAO;
use App\Http\Controllers\Classes\BasketSession;
use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\WebOrderDetailDAO;
use App\Http\Controllers\Classes\WebOrderDetail;
use App\Http\Controllers\Classes\AgentViewDAO;
use App\Http\Controllers\Classes\ProfileDAO;

use App\Mail\AcceptanceResult;
use App\Mail\ReserveAcceptanceResult;

class RecognizeTop extends Controller
{
/******************************************
 * 承認／否認 
 ******************************************/
    function index(Request $request)
	{
		$id = $request->id;
		$aid = $request->aid;
		if (!empty($request->msg) ) {
			$msg = "更新が完了しました。";
		} else {
			$msg = "";
		}

		// 受注承諾情報テーブル検索
		$orderAcceptanceDAO = new OrderAcceptanceDAO();
		try {
			$orderacceptance = $orderAcceptanceDAO->find($id, $aid);

		} catch(Exception $e) {
			return view('weborder.recognize.error', [
				'error_message' => '該当するデータがありません。',
			]);
		}

		if (empty($orderacceptance->order_acceptance_header_no) ) {
			return view('weborder.recognize.error', [
				'error_message' => '該当するデータがありません。',
			]);
		}


		// WEB受注基本テーブル検索
		$webOrderHeaderDAO = new WebOrderHeaderDAO();
		$weborderheader = $webOrderHeaderDAO->find($orderacceptance->order_acceptance_header_no);

		// WEB受注詳細テーブル検索
		$webOrderDetailDAO = new WebOrderDetailDAO();
		$weborderdetailList = $webOrderDetailDAO->findNamePlus($orderacceptance->order_acceptance_header_no);

		session()->put("acceptance"        , $orderacceptance->toArray());
//		session()->put("weborderdetailList", $weborderdetail->toArray($weborderdetailList));
		session()->put("weborderdetailList", $weborderdetailList);

		// 既に承認処理済の場合はエラー
		if ($orderacceptance->order_acceptance_flag != "") {
			return view('weborder.recognize.already', [
				'order_acceptance_flag' => $orderacceptance->order_acceptance_flag,
			]);
		}

		// 削除済み
		if ($weborderheader->cust_del_type == "1" || $weborderheader->operator_del_type == "1") { // 得意先用削除区分 担当者用削除区分
			return view('weborder.already', [
				'order_acceptance_flag' => "99",
			]);
		}

		// 顧客情報検索
		$agentviewDAO = new AgentViewDAO();
		$agentview = $agentviewDAO->findById($orderacceptance->order_acceptance_cust_code);

		$profileDAO = new ProfileDAO();
		$profile = $profileDAO->findWeb($orderacceptance->order_acceptance_cust_code);

		$header = $weborderheader->toArray();

		$header['frm_regist_zip1'] = substr($weborderheader->post ,0 ,3);
		$header['frm_regist_zip2'] = substr($weborderheader->post ,3 ,4);

		if (!empty($weborderheader->tel)) {
			$tel = explode("-" ,$weborderheader->tel);
			$header['frm_regist_tel1'] = $tel[0];
			$header['frm_regist_tel2'] = $tel[1];
			$header['frm_regist_tel3'] = $tel[2];
		}
		
		if (!empty($communicate_tel)) {
			$communicate_tel = explode("-" ,$weborderheader->communicate_tel);
			$header['frm_regist_contact_tel1'] = $communicate_tel[0];
			$header['frm_regist_contact_tel2'] = $communicate_tel[1];
			$header['frm_regist_contact_tel3'] = $communicate_tel[2];
		}

		if (!empty($weborderheader->fax)) {
			$fax = explode("-" ,$weborderheader->fax);
			$header['frm_regist_contact_fax1'] = $fax[0];
			$header['frm_regist_contact_fax2'] = $fax[1];
			$header['frm_regist_contact_fax3'] = $fax[2];
		}

		// セッションにセット
		session()->put("dwo_profile"       , $profile->toArray());
		session()->put("agentView"         , $agentview);
		session()->put("weborderheader"    , $header);
		session()->put("id"                , $id);
		session()->put("aid"               , $aid);
		session()->put("msg"               , $msg);

		return view('weborder.recognize.top',
		[
			'agentview' => $agentview,
		]);
    }


/******************************************
 * 承認／否認 チェック
 ******************************************/
    function check(Request $request)
	{
		$ses_acceptance = session()->get('acceptance');
		$orderacceptancedao = new OrderAcceptanceDAO();
		$orderacceptance = $orderacceptancedao->find($ses_acceptance['order_acceptance_seq'], $ses_acceptance['order_acceptance_id']);
		// 既に承認処理済の場合はエラー
		if ($orderacceptance->order_acceptance_flag != "") {
			return view('weborder.recognize.already', [
				'order_acceptance_flag' => $orderacceptance->order_acceptance_flag,
			]);
		}

		$exec = null;

		if ($request->has('do_accept') ) {
			$exec = "ok";
		} else if ($request->has('do_reject') ) {
			$exec = "ng";
		} else {

			return view('weborder.recognize.error', [
				'error_message' => '該当するデータがありません。',
			]);
		}

		return view('weborder.recognize.check',[
			'exec' => $exec,
		]);
    }


/******************************************
 * 承認／否認 実行
 ******************************************/
    function do(Request $request)
    {
		// セッションから取得
		$acceptance         = session()->get("acceptance");
		$weborderheader     = session()->get("weborderheader");
		$weborderdetailList = session()->get("weborderdetailList");
		$agentView          = session()->get("agentView");
		$dwo_profile        = session()->get("dwo_profile");

		$webOrderHeaderDAO  = new WebOrderHeaderDAO();

		$orderAcceptanceDAO = new OrderAcceptanceDAO();
		$orderacceptance = $orderAcceptanceDAO->find($acceptance['order_acceptance_seq'], $acceptance['order_acceptance_id']);
		// 既に承認処理済の場合はエラー
		if ($orderacceptance->order_acceptance_flag != "") {
			return view('weborder.recognize.already', [
				'order_acceptance_flag' => $orderacceptance->order_acceptance_flag,
			]);
		}

		$order_acceptance_flag = ""; // OrderAcceptance用
		$state_type            = ""; // WebOrderHeader用


		$acceptance_action = $request->acceptance_action;

		if ($acceptance_action == "ok") {
			$order_acceptance_flag = "1";
			// 4:承認待ちから0:受付け中、または9:予約承認待ちから8:予約受付中に
			$state_type = ($weborderheader['state_type'] == "4") ? "0" : "8";

		} else if ($acceptance_action == "ng") {
			$order_acceptance_flag = "2";
			$state_type = "6";

		} else {
			return view('weborder.recognize.error', [
				'error_message' => '該当するデータがありません。',
			]);
		}

		$webOrderHeaderDAO->updateStatusPreChk($acceptance['order_acceptance_header_no'], $state_type);
		$orderAcceptanceDAO->updateStatus($acceptance['order_acceptance_seq'], $acceptance['order_acceptance_id'], $order_acceptance_flag);

		session()->put("acceptance_action", $acceptance_action);

		// 承認結果メール送信処理 ========================================================================================
		// 条件判定データ
		/*
		 * 	本文タイプ: SYONIN_OK      : お客様からの承認OK報告
		 * 				SYONIN_NG      : お客様からの否認報告
		 */

    	$mailTo = array();

		if ($dwo_profile['profile_mail_flag']) {
			$mailTo[] = $agentView->mail_address;
		}

		if ($dwo_profile['profile_extra_mail_flag']) {
			$mailTo[] = $dwo_profile['profile_extra_mail'];
		}

		if ($mailTo) {

			$order_num = $acceptance['order_acceptance_header_no'];
			
			if (($weborderheader['state_type'] == "9") && ($acceptance_action == "ok")) {

				$subject = "【弥生Webオーダー（予約）】ご注文受付完了のお知らせ[受付No.$order_num]";
				Mail::send(new ReserveAcceptanceResult($subject, $mailTo, $agentView, $weborderdetailList, $weborderheader, $acceptance ));

			} else {

			if ($acceptance_action == "ok") {
					$subject = "【弥生Webオーダー】ご注文受付完了のお知らせ[受付No.$order_num]";
				} else {
					$subject = "【弥生Webオーダー】ご注文キャンセルのお知らせ[受付No.$order_num]";
				}
				Mail::send(new AcceptanceResult($acceptance_action, $subject, $mailTo, $agentView, $weborderdetailList, $weborderheader, $acceptance ));
			}

		}

		return redirect()->route('recognize.result')->with('acceptance_action', $acceptance_action);
    }


}
