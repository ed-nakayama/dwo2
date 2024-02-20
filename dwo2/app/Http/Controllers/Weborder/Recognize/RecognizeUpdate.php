<?php

namespace App\Http\Controllers\Weborder\Recognize;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Classes\OrderAcceptanceDAO;
use App\Http\Controllers\Classes\WebOrderHeaderDAO;
use App\Http\Controllers\Classes\ProfileDAO;

use App\Models\ORDER_HDR;

use App\Mail\InfoUpdate;

class RecognizeUpdate extends Controller
{
    function index(Request $request)
	{
		$id = session()->get("id");
		$aid = session()->get("aid");

		// 受注承諾情報テーブル検索
		$orderacceptancedao = new OrderAcceptanceDAO();
		try {
			$orderacceptance = $orderacceptancedao->find($id, $aid);
		} catch(Exception $e) {
			return view('weborder.recognize.error', [
				'error_msg' => '該当するデータがありません。',
			]);
		}

		if ($orderacceptance->order_acceptance_header_no == "") {
			return view('weborder.recognize.error', [
				'error_msg' => '該当するデータがありません。',
			]);
		}

		// WEB受注基本テーブル検索
		$weborderheaderdao = new WebOrderHeaderDAO();
		$weborderheader = $weborderheaderdao->find($orderacceptance->order_acceptance_header_no);

		// 既に承認処理済の場合はエラー
		if ($orderacceptance->order_acceptance_flag != "") {
			return view('weborder.recognize.already', [
				'order_acceptance_flag' => $orderacceptance->order_acceptance_flag,
			]);
		}

		// 削除済み
		if ($weborderheader->cust_del_type == "1" || $weborderheader->operator_del_type == "1") { // 得意先用削除区分 担当者用削除区分
			return view('weborder.recognize.already', [
				'order_acceptance_flag' => "99",
			]);
		}


		$header = $weborderheader->toArray();

		$header['frm_regist_zip1'] = substr($weborderheader->post ,0 ,3);
		$header['frm_regist_zip2'] = substr($weborderheader->post ,3 ,4);

		$tel = array('','','');
		$communicate_tel = array('','','');
		$fax = array('','','');
		if (!empty($weborderheader->tel)) $tel = explode("-" ,$weborderheader->tel);
		if (!empty($weborderheader->communicate_tel)) $communicate_tel = explode("-" ,$weborderheader->communicate_tel);
		if (!empty($weborderheader->fax)) $fax = explode("-" ,$weborderheader->fax);


		session()->put("weborderheader"    ,$header);


		return view('weborder.recognize.update',[
			'frm_regist_name'                => $weborderheader->name1 . $weborderheader->name2,
			'frm_name_kana'                  => $weborderheader->name_kana1,
			'frm_regist_ceo'                 => $weborderheader->president_name1,
			'frm_regist_ceo_kana'            => $weborderheader->president_name_kana1,
			'frm_regist_name_of_charge'      => $weborderheader->contact_name1,
			'frm_regist_name_of_charge_kana' => $weborderheader->contact_name_kana1,
			'frm_regist_mail'                => $weborderheader->mail_address,
			'frm_regist_url'                 => $weborderheader->url,
			'frm_regist_zip1'                => substr($weborderheader->post ,0 ,3),
			'frm_regist_zip2'                => substr($weborderheader->post ,3 ,4),
			'frm_regist_pref_cd'             => $weborderheader->prefecture_cd,
			'frm_regist_add1'                => $weborderheader->address1,
			'frm_regist_add2'                => $weborderheader->address2,
			'frm_regist_add3'                => $weborderheader->address3,
			'frm_regist_tel1'                => $tel[0],
			'frm_regist_tel2'                => $tel[1],
			'frm_regist_tel3'                => $tel[2],
			'frm_regist_contact_tel1'        => $communicate_tel[0],
			'frm_regist_contact_tel2'        => $communicate_tel[1],
			'frm_regist_contact_tel3'        => $communicate_tel[2],
			'frm_regist_contact_fax1'        => $fax[0],
			'frm_regist_contact_fax2'        => $fax[1],
			'frm_regist_contact_fax3'        => $fax[2],
		]);
    }


    function updateDo(Request $request)
    {
		$id = session()->get("id");
		$aid = session()->get("aid");

		$orderinfo = session()->get("weborderheader");
		$orderacceptance = session()->get("acceptance");
		$agentView = session()->get("agentView");
		$weborderdetailList = session()->get("weborderdetailList");

		// 全角変換
		if ($orderinfo['contents_type'] != "54" && $orderinfo['contents_type'] != "55") {
			
			$regName = mb_convert_kana($request->frm_regist_name, "KVAS");
			 
			$orderinfo['name1'] = mb_substr($regName ,0, 16); // 顧客名１
			$orderinfo['name2'] = (mb_strlen($regName) > 16) ? mb_substr($regName,16) : ""; // 顧客名２

			
			$orderinfo['name_kana1'] = mb_convert_kana($request->frm_regist_kana, "KVAS");
			$orderinfo['president_name1'] = mb_convert_kana($request->frm_regist_ceo, "KVAS");
			$orderinfo['president_name_kana1'] = mb_convert_kana($request->frm_regist_ceo_kana, "KVAS");
		}

		$orderinfo['address1'] = mb_convert_kana($request->frm_regist_add1, "KVAS");
		$orderinfo['address2'] = mb_convert_kana($request->frm_regist_add2, "KVAS");
		$orderinfo['address3'] = mb_convert_kana($request->frm_regist_add3, "KVAS");

		$orderinfo['contact_name1']      = $request->frm_regist_name_of_charge;
		$orderinfo['contact_name_kana1'] = $request->frm_regist_name_of_charge_kana;

		$orderinfo['post']            = $request->frm_regist_zip1 . $request->frm_regist_zip2;
		$orderinfo['prefecture_cd']   = $request->frm_regist_pref_cd;
		$orderinfo['tel']             = $request->frm_regist_tel1 . "-" . $request->frm_regist_tel2 . "-" . $request->frm_regist_tel3;
		$orderinfo['communicate_tel'] = $request->frm_regist_contact_tel1 . "-" . $request->frm_regist_contact_tel2 . "-" . $request->frm_regist_contact_tel3;
		$orderinfo['fax']             = $request->frm_regist_contact_fax1 . "-" . $request->frm_regist_contact_fax2 . "-" . $request->frm_regist_contact_fax3;
		$orderinfo['mail_address']    = $request->frm_regist_mail;
		$orderinfo['url']             = $request->frm_regist_url;

		$order = ORDER_HDR::find($orderinfo['web_order_num']);

		$order->post                 = $orderinfo['post'];
		$order->prefecture_cd        = $orderinfo['prefecture_cd'];
		$order->address1             = $orderinfo['address1'];
		$order->address2             = $orderinfo['address2'];
		$order->address3             = $orderinfo['address3'];
		$order->contact_name1        = $orderinfo['contact_name1'];
		$order->contact_name_kana1   = $orderinfo['contact_name_kana1'];
		$order->tel                  = $orderinfo['tel'];
		$order->communicate_tel      = $orderinfo['communicate_tel'];
		$order->fax                  = $orderinfo['fax'];
		$order->license_mail_address = $orderinfo['mail_address'];
		$order->url                  = $orderinfo['url'];
		
		
		if ($orderinfo['contents_type'] != "54" && $orderinfo['contents_type'] != "55") {
			$order->name1                = $orderinfo['name1'];
			$order->name2                = $orderinfo['name2'];
			$order->name_kana1           = $orderinfo['name_kana1'];
			$order->president_name1      = $orderinfo['president_name1'];
			$order->president_name_kana1 = $orderinfo['president_name_kana1'];
		}

		$order->save();


		$profileDAO = new ProfileDAO();
		$profile = $profileDAO->findWeb($agentView->cust_num);
//		$profile->toArray();

		$mailTo = array();

		if ($profile->profile_mail_flag) {
			$mailTo[] = $agentView->mail_address;
		}

		if ($profile->profile_extra_mail_flag) {
			$mailTo[] = $profile->profile_extra_mail;
		}

		if ($mailTo) {
			$order_num = $orderinfo['web_order_num'];
			$title ="【弥生Webオーダー】お客様情報登録内容変更のお知らせ[受付No.$order_num]";
			Mail::send(new InfoUpdate($title, $mailTo, $agentView, $orderacceptance, $orderinfo, $weborderdetailList) );
		}
		
		session()->put("weborderheader"    , $orderinfo);

		return redirect()->route('recognize.top', 
			[
			'id'    => $id,
			'aid'   => $aid,
			'msg'   => '1',
			]);

    }

}

