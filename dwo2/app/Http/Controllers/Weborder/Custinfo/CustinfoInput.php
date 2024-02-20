<?php

namespace App\Http\Controllers\Weborder\Custinfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Classes\OrderInfoSession;
use App\Http\Controllers\Classes\MbConvUtil;

class CustinfoInput extends Controller
{
    function index()
    {
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		return view('weborder.custinfo.input',
			[
			'orderinfo'   => $orderinfo,
			]
		);
	}


/************************************
 * •Û‘¶
 ************************************/
   function store(Request $request)
    {
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();

		$validated = $request->validate([
			'frm_regist_name'     => ['required' ,'string'],
			'frm_regist_kana'     => ['required' ,'string'],
			'frm_regist_zip1'     => ['required'],
			'frm_regist_zip2'     => ['required'],
			'frm_regist_pref_cd'  => ['required'],
			'frm_regist_add1'     => ['required' ,'string'],
			'frm_regist_add2'     => ['required' ,'string'],
			'frm_regist_tel1'     => ['required'],
			'frm_regist_tel2'     => ['required'],
			'frm_regist_tel3'     => ['required'],
			'frm_regist_mail'     => ['nullable','email','confirmed'],
		]);


		if ($orderinfo->cust_kbn != "OR") {
			$validated = $request->validate([
			'frm_regist_mail'     => ['required','email','confirmed'],
			]);
		}
		
		$orderinfo->regist_name                = mb_convert_kana($request->input("frm_regist_name"), "KVAS");
		$orderinfo->regist_kana                = mb_convert_kana($request->input("frm_regist_kana"), "KVAS");
		$orderinfo->regist_zip1                = mb_convert_kana($request->input("frm_regist_zip1"), "KVAS");
		$orderinfo->regist_zip2                = mb_convert_kana($request->input("frm_regist_zip2"), "KVAS");
		$orderinfo->regist_pref_cd             = mb_convert_kana($request->input("frm_regist_pref_cd"), "KVAS");
		$orderinfo->regist_pref                = mb_convert_kana($request->input("frm_regist_pref"), "KVAS");
		$orderinfo->regist_add1                = mb_convert_kana($request->input("frm_regist_add1"), "KVAS");
		$orderinfo->regist_add2                = mb_convert_kana($request->input("frm_regist_add2"), "KVAS");
		$orderinfo->regist_add3                = mb_convert_kana($request->input("frm_regist_add3"), "KVAS");
		$orderinfo->regist_ceo                 = mb_convert_kana($request->input("frm_regist_ceo"), "KVAS");
		$orderinfo->regist_ceo_kana            = mb_convert_kana($request->input("frm_regist_ceo_kana"), "KVAS");
		$orderinfo->regist_name_of_charge      = mb_convert_kana($request->input("frm_regist_name_of_charge"), "KVAS");
		$orderinfo->regist_name_of_charge_kana = mb_convert_kana($request->input("frm_regist_name_of_charge_kana"), "KVAS");
		$orderinfo->regist_tel1                = mb_convert_kana($request->input("frm_regist_tel1"), "KVAS");
		$orderinfo->regist_tel2                = mb_convert_kana($request->input("frm_regist_tel2"), "KVAS");
		$orderinfo->regist_tel3                = mb_convert_kana($request->input("frm_regist_tel3"), "KVAS");
		$orderinfo->regist_contact_tel1        = mb_convert_kana($request->input("frm_regist_contact_tel1"), "KVAS");
		$orderinfo->regist_contact_tel2        = mb_convert_kana($request->input("frm_regist_contact_tel2"), "KVAS");
		$orderinfo->regist_contact_tel3        = mb_convert_kana($request->input("frm_regist_contact_tel3"), "KVAS");
		$orderinfo->regist_contact_fax1        = mb_convert_kana($request->input("frm_regist_contact_fax1"), "KVAS");
		$orderinfo->regist_contact_fax2        = mb_convert_kana($request->input("frm_regist_contact_fax2"), "KVAS");
		$orderinfo->regist_contact_fax3        = mb_convert_kana($request->input("frm_regist_contact_fax3"), "KVAS");
		$orderinfo->regist_mail                = mb_convert_kana($request->input("frm_regist_mail"), "KVAS");
		$orderinfo->regist_url                 = mb_convert_kana($request->input("frm_regist_url"), "KVAS");

		// ‘SŠp•ÏŠ·
		$orderinfo->regist_name                = mb_convert_kana($orderinfo->regist_name, "KVAS");
		$orderinfo->regist_kana                = mb_convert_kana($orderinfo->regist_kana, "KVAS");
		$orderinfo->regist_add1                = mb_convert_kana($orderinfo->regist_add1, "KVAS");
		$orderinfo->regist_add2                = mb_convert_kana($orderinfo->regist_add2, "KVAS");
		$orderinfo->regist_add3                = mb_convert_kana($orderinfo->regist_add3, "KVAS");
		$orderinfo->regist_ceo                 = mb_convert_kana($orderinfo->regist_ceo, "KVAS");
		$orderinfo->regist_ceo_kana            = mb_convert_kana($orderinfo->regist_ceo_kana, "KVAS");
		$orderinfo->regist_name_of_charge      = mb_convert_kana($orderinfo->regist_name_of_charge, "KVAS");
		$orderinfo->regist_name_of_charge_kana = mb_convert_kana($orderinfo->regist_name_of_charge_kana, "KVAS");

		$orderinfosession->set($orderinfo);

		return redirect()->route('order.confirm');
    }


}
