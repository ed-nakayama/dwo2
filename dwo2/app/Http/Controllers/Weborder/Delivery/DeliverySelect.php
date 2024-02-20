<?php

namespace App\Http\Controllers\Weborder\Delivery;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Controllers\Classes\OrderInfoSession;
use App\Http\Controllers\Classes\BasketSession;
use App\Http\Controllers\Classes\DeliveryDAO;


class DeliverySelect extends Controller
{
    function index(Request $request)
    {

		$agentView = session('agentView'); // セッションから顧客情報を取得しておく
		$orderinfosession = new OrderInfoSession();
		$orderinfo = $orderinfosession->get();


		if ($request->input("orderDetailSubmit") == "on") {
			// セッションはprepare()でスタート済み
			$basketsession = new BasketSession();
			$bskAry = $basketsession->toArray();

			$chk_item_class_large = FALSE;
			for ($i=0; $i<count($bskAry); $i++) {
				// 指定商品IDのバスケットを取得
				$basket = $basketsession->getBasket($bskAry[$i]['product_code'], $bskAry[$i]['support_code']);
				$basket->cust_order_num = $request->input("frm_cust_order_num_".$bskAry[$i]['product_code']."_".$bskAry[$i]['support_code']); // フォーム値の発注Noを取得
				$basketsession->EditBasket($basket);

				if ($basket->item_class_large == "01") {
					$chk_item_class_large = TRUE;
				}
			}

			$orderinfo->order_tantou_name   = $request->input("frm_order_tantou_name");
			$orderinfo->double_package_type = $request->input("frm_double_package_type");
			$orderinfo->remarks             = $request->input("frm_remarks");

			// 全角変換
			$orderinfo->order_tantou_name = mb_convert_kana($orderinfo->order_tantou_name, "KVAS");
			$orderinfo->remarks           = mb_convert_kana($orderinfo->remarks, "KVAS");


			// ログイン顧客自身のため伝票送付あり(フラグは0)
			$orderinfo->direct_delivery_type= "0";

			$orderinfo->delivery_seq             = "";
			$orderinfo->delivery_cust_code       = $agentView->cust_num;
			$orderinfo->delivery_name            = $agentView->name1 . $agentView->name2;

			$orderinfo->delivery_zip             = $agentView->post;

			$orderinfo->delivery_pref_cd         = $agentView->pref_cd;
			$orderinfo->delivery_pref            = $agentView->pref;
			$orderinfo->delivery_add1            = mb_substr($agentView->address1, 0, 25);
			$orderinfo->delivery_add2            = mb_substr($agentView->address2, 0, 25);
			$orderinfo->delivery_add3            = mb_substr($agentView->address3, 0, 25);

			if ($orderinfo->order_tantou_name == "") {
				$orderinfo->order_tantou_name        = mb_substr($agentView->contact_name1, 0, 8); // 設定なしの場合は顧客データより
				$orderinfo->delivery_name_of_charge  = mb_substr($agentView->contact_name1, 0, 8); // 設定なしの場合は顧客データより
			} else {
				//$orderinfo->order_tantou_name        = $orderinfo->order_tantou_name; // ここは前ページの設定となる
				$orderinfo->delivery_name_of_charge  = $orderinfo->order_tantou_name; // ここは前ページの設定となる
			}

			$ary = explode("-", $agentView->tel); // -で分割
				if (count($ary) < 3) {
					$ary[] = "";
					$ary[] = "";
					$ary[] = "";
				}
			$orderinfo->delivery_tel1            = $ary[0];
			$orderinfo->delivery_tel2            = $ary[1];
			$orderinfo->delivery_tel3            = $ary[2];
			$ary = explode("-", $agentView->fax); // -で分割
				if (count($ary) < 3) {
					$ary[] = "";
					$ary[] = "";
					$ary[] = "";
				}
			$orderinfo->delivery_fax1            = $ary[0];
			$orderinfo->delivery_fax2            = $ary[1];
			$orderinfo->delivery_fax3            = $ary[2];

			// 画面遷移と承認メールの有無をセッションに登録
			$orderinfo->cust_regist_flg = ""; // 初期化
			$orderinfo->syonin_mail_flg = ""; // 初期化
			// PAP製品購入フローの場合
			if ($orderinfo->pap_order) {
				// 製品が含まれる場合はお客様情報入力あり
				if ($chk_item_class_large) {
					$orderinfo->cust_regist_flg = "1";
					$orderinfo->syonin_mail_flg = "1";
				}
				// オリコン・ＴＭの場合は承認メールなし
				if ($orderinfo->cust_kbn == "OR") {
					$orderinfo->syonin_mail_flg = "";
				}
			}
			// テンプレ表示先を貴社から納品先に表示するセッション情報をクリア
			session()->put("keep_deliveryotherview", "貴社");
		}

		if ($request->input("resetDeliverySubmit") == "on") {
			// テンプレ表示先を貴社から納品先に表示するセッション情報をセット
			session()->put("keep_deliveryotherview", "納品先");

			$deliverydao = new DeliveryDAO();

			// 別の納品先を指定された場合はここで条件追加
			$param['delivery_cust_code'] = \Auth::user()->profile_cust_code;
			$param['delivery_seq'] = $request->frm_delivery_seq;
			$deliveryList = $deliverydao->findweb($param); // データ検索

			if (count($deliveryList) > 0) {
				$data = $deliveryList[0]; // 条件を付加しているので必ず１件のみ取得できる

				// 納品先変更のため伝票送付なし(フラグ1)
				$orderinfo->direct_delivery_type= "1";

				$orderinfo->delivery_seq             = $data->delivery_seq;
				$orderinfo->delivery_cust_code       = $data->delivery_cust_code;
				$orderinfo->delivery_name            = $data->delivery_name;
	
				$orderinfo->delivery_zip             = $data->delivery_zip;
	
				$orderinfo->delivery_pref_cd         = $data->delivery_pref_cd;
				$orderinfo->delivery_pref            = $data->delivery_pref;

				$orderinfo->delivery_add1            = $data->delivery_add1;
				$orderinfo->delivery_add2            = $data->delivery_add2;
				$orderinfo->delivery_add3            = $data->delivery_add3;
				$orderinfo->delivery_name_of_charge  = $request->input("resetDeliveryPerson");

				// 全角変換
				$orderinfo->delivery_name_of_charge = mb_convert_kana($orderinfo->delivery_name_of_charge, "KVAS");

				$ary = explode("-", $data->delivery_tel); // -で分割
				if (count($ary) < 3) {
					$ary[] = "";
					$ary[] = "";
					$ary[] = "";
				}
				$orderinfo->delivery_tel1            = $ary[0];
				$orderinfo->delivery_tel2            = $ary[1];
				$orderinfo->delivery_tel3            = $ary[2];
				$ary = explode("-", $data->delivery_fax); // -で分割
				if (count($ary) < 3) {
					$ary[] = "";
					$ary[] = "";
					$ary[] = "";
				}
				$orderinfo->delivery_fax1            = $ary[0];
				$orderinfo->delivery_fax2            = $ary[1];
				$orderinfo->delivery_fax3            = $ary[2];
			}
		}

		// 次回以降表示用としてセッションにセット 発注Noや備考などがセットされる
		$orderinfosession->set($orderinfo);

		return view('weborder.delivery.select' ,
			[
			'orderinfo'      => $orderinfo,
			]
		);

    }
}
