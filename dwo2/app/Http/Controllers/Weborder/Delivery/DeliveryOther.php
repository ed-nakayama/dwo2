<?php

namespace App\Http\Controllers\Weborder\Delivery;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Classes\DeliveryDAO;

use App\Models\DeliveryMt;


class DeliveryOther extends Controller
{
/***************************************
 * 別途納品先
 ***************************************/
    function index(Request $request)
    {
		// 納品先検索
		$deliveryDAO = new DeliveryDAO();

		// 条件セット
		$param['delivery_cust_code'] = \Auth::user()->profile_cust_code;
		$param['delivery_seq'] = $request->frm_delivery_seq;
		$param['delivery_name'] = $request->frm_delivery_name;
		$param['delivery_tel'] = $request->frm_delivery_tel;

		// データ検索
		$otherList = $deliveryDAO->findweb($param);
		$cnt = count($otherList);

		return view('weborder.delivery.other' ,
			[
			'OtherListCount'    => $cnt,
			'OtherList'         => $otherList,
			'frm_delivery_seq'  => $request->input("frm_delivery_seq"),
			'frm_delivery_name' => $request->input("frm_delivery_name"),
			'frm_delivery_tel'  => $request->input("frm_delivery_tel"),
			]
		);

    }


/***************************************
 * 新規登録 入力
 ***************************************/
    function regist(Request $request)
    {
		return view('weborder.delivery.regist',
			[
			'reg_delivery_name'    => $request->input('reg_delivery_name'),
			'reg_delivery_name_of_charge' => $request->input('reg_delivery_name_of_charge'),
			'reg_delivery_zip1'    => $request->input('reg_delivery_zip1'),
			'reg_delivery_zip2'    => $request->input('reg_delivery_zip2'),
			'reg_delivery_pref_cd' => $request->input('reg_delivery_pref_cd'),
			'reg_delivery_add1'    => $request->input('reg_delivery_add1'),
			'reg_delivery_add2'    => $request->input('reg_delivery_add2'),
			'reg_delivery_add3'    => $request->input('reg_delivery_add3'),
			'reg_delivery_tel1'    => $request->input('reg_delivery_tel1'),
			'reg_delivery_tel2'    => $request->input('reg_delivery_tel2'),
			'reg_delivery_tel3'    => $request->input('reg_delivery_tel3'),
			'reg_delivery_fax1'    => $request->input('reg_delivery_fax1'),
			'reg_delivery_fax2'    => $request->input('reg_delivery_fax2'),
			'reg_delivery_fax3'    => $request->input('reg_delivery_fax3'),
			]
		);
    }


/***************************************
 * 新規登録 保存
 ***************************************/
    function store(Request $request)
    {
		$validatedData = $request->validate([
			'reg_delivery_name'    => ['required'],
			'reg_delivery_zip1'    => ['required'],
			'reg_delivery_zip2'    => ['required'],
			'reg_delivery_pref_cd' => ['required'],
			'reg_delivery_add1'    => ['required'],
			'reg_delivery_add2'    => ['required'],
			'reg_delivery_tel1'    => ['required'],
			'reg_delivery_tel2'    => ['required'],
			'reg_delivery_tel3'    => ['required'],
		]);

		$user = Auth::user();// 顧客番号を取得

		$delivery_fax = $request->reg_delivery_fax1 ."-" . $request->reg_delivery_fax2 . "-" . $request->reg_delivery_fax3; // 納品先FAX番号 (-)ハイフンあり
		if ($delivery_fax != "--") {
			$delivery_fax = null;
		}

		// 新規追加
		$delivery_seq = DeliveryMt::where('delivery_cust_code', $user->profile_cust_code)->max('delivery_seq') + 1;

		DeliveryMt::create([
				'delivery_cust_code'      => $user->profile_cust_code,
				'delivery_seq'            => $delivery_seq,
				'delivery_name'           => mb_convert_kana($request->reg_delivery_name, "KVAS"),
				'delivery_name_of_charge' => mb_convert_kana($request->reg_delivery_name_of_charge, "KVAS"),
				'delivery_tel'            => $request->reg_delivery_tel1 . "-" . $request->reg_delivery_tel2 . "-" . $request->reg_delivery_tel3, // 納品先電話番号 (-)ハイフンあり
				'delivery_fax'            => $delivery_fax,
				'delivery_zip'            => $request->reg_delivery_zip1 . $request->reg_delivery_zip2, // 納品先郵便番号(-)ハイフンなし,
				'delivery_pref'           => $request->reg_delivery_pref_cd, // 納品先都道府県コード
				'delivery_add1'           => mb_convert_kana($request->delivery_add1, "KVAS"),
				'delivery_add2'           => mb_convert_kana($request->delivery_add2, "KVAS"),
				'delivery_add3'           => mb_convert_kana($request->delivery_add3, "KVAS"),
				'delivery_del'            => '0',
			]);

		return redirect()->route('delivery.other', 
			[
			'frm_delivery_seq'  => $request->input("frm_delivery_seq"),
			'frm_delivery_name' => $request->input("frm_delivery_name"),
			'frm_delivery_tel'  => $request->input("frm_delivery_tel"),
			])
			->with('status', 'success-store');


    }


}