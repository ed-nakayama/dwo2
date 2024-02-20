<?php

namespace App\Http\Controllers\Classes;

define("DWOORDERINFO", "DwoOrderInfo");

class OrderInfoSession {

	private $orderinfolist;

	/*
	 * コンストラクタ
     * 引数：セッション
	 */
	function __construct() {
		$this->orderinfolist = new OrderInfo();
		$this->setFromSession();

	}

	/*
	 * セッションから取得
	 */
	function setFromSession() {
		$this->orderinfolist = session()->get(DWOORDERINFO);
	}

	/*
	 * セッションに保存
	 */
	function setToSession() {
//		$this->my_session->set(DWOORDERINFO, $this->orderinfolist);
		session()->put(DWOORDERINFO, $this->orderinfolist);
	}

	/*
	 * 受注情報追加
	 */
	function set($oInfo) {
		$this->orderinfolist = $oInfo;
		$this->setToSession();
    }

	/*
	 * 受注情報を初期化
	 */
	function clear() {
		$this->orderinfolist = new OrderInfo();
		$this->setToSession();
	}

	/*
	 * 指定product_codeのBasketクラスを返す
	 */
	function get() {
		return $this->orderinfolist;
	}

	/*
	 * オーダー完了時のオブジェクト初期化用
	 * 引き続き注文を継続する場合を考慮し必要な情報以外をクリアする。
	 */
	function resetComplete() {
		//$this->orderinfolist->cust_kbn                  = ""; // クリアしない
		//$this->orderinfolist->pap_order                 = ""; // クリアしない
		$this->orderinfolist->syonin_mail_flg           = "";
		$this->orderinfolist->cust_regist_flg           = "";
		$this->orderinfolist->direct_delivery_type      = "";
		$this->orderinfolist->frm_cust_order_num        = "";
		$this->orderinfolist->order_tantou_name         = "";
		$this->orderinfolist->double_package_type       = "";
		$this->orderinfolist->remarks                   = "";
		$this->orderinfolist->delivery_cust_code        = "";
		$this->orderinfolist->delivery_seq              = "";
		$this->orderinfolist->delivery_name             = "";
		$this->orderinfolist->delivery_zip              = "";
		$this->orderinfolist->delivery_pref             = "";
		$this->orderinfolist->delivery_pref_cd          = "";
		$this->orderinfolist->delivery_add1             = "";
		$this->orderinfolist->delivery_add2             = "";
		$this->orderinfolist->delivery_add3             = "";
		$this->orderinfolist->delivery_name_of_charge   = "";
		$this->orderinfolist->delivery_tel1             = "";
		$this->orderinfolist->delivery_tel2             = "";
		$this->orderinfolist->delivery_tel3             = "";
		$this->orderinfolist->delivery_fax1             = "";
		$this->orderinfolist->delivery_fax2             = "";
		$this->orderinfolist->delivery_fax3             = "";
		$this->orderinfolist->regist_name               = "";
		$this->orderinfolist->regist_kana               = "";
		$this->orderinfolist->regist_zip1               = "";
		$this->orderinfolist->regist_zip2               = "";
		$this->orderinfolist->regist_pref               = "";
		$this->orderinfolist->regist_pref_cd            = "";
		$this->orderinfolist->regist_add1               = "";
		$this->orderinfolist->regist_add2               = "";
		$this->orderinfolist->regist_add3               = "";
		$this->orderinfolist->regist_ceo                = "";
		$this->orderinfolist->regist_ceo_kana           = "";
		$this->orderinfolist->regist_name_of_charge     = "";
		$this->orderinfolist->regist_name_of_charge_kana= "";
		$this->orderinfolist->regist_tel1               = "";
		$this->orderinfolist->regist_tel2               = "";
		$this->orderinfolist->regist_tel3               = "";
		$this->orderinfolist->regist_contact_tel1       = "";
		$this->orderinfolist->regist_contact_tel2       = "";
		$this->orderinfolist->regist_contact_tel3       = "";
		$this->orderinfolist->regist_contact_fax1       = "";
		$this->orderinfolist->regist_contact_fax2       = "";
		$this->orderinfolist->regist_contact_fax3       = "";
		$this->orderinfolist->regist_mail               = "";
		$this->orderinfolist->regist_url                = "";

		$this->orderinfolist->disable_upgrade           = "";
	}

	/*
	 * 受注情報配列化
	 */
	function toArray() {
		$datList['cust_kbn'                  ] = $this->orderinfolist->cust_kbn                  ;
		$datList['pap_order'                 ] = $this->orderinfolist->pap_order                 ;
		$datList['upgrade_order'             ] = $this->orderinfolist->upgrade_order             ;
		$datList['syonin_mail_flg'           ] = $this->orderinfolist->syonin_mail_flg           ;
		$datList['cust_regist_flg'           ] = $this->orderinfolist->cust_regist_flg           ;
		$datList['direct_delivery_type'      ] = $this->orderinfolist->direct_delivery_type      ;
		$datList['frm_cust_order_num'        ] = $this->orderinfolist->frm_cust_order_num        ;
		$datList['order_tantou_name'         ] = $this->orderinfolist->order_tantou_name         ;
		$datList['double_package_type'       ] = $this->orderinfolist->double_package_type       ;
		$datList['remarks'                   ] = $this->orderinfolist->remarks                   ;
		$datList['delivery_cust_code'        ] = $this->orderinfolist->delivery_cust_code        ;
		$datList['delivery_seq'              ] = $this->orderinfolist->delivery_seq              ;
		$datList['delivery_name'             ] = $this->orderinfolist->delivery_name             ;
		$datList['delivery_zip'              ] = $this->orderinfolist->delivery_zip              ;
		$datList['delivery_pref'             ] = $this->orderinfolist->delivery_pref             ;
		$datList['delivery_pref_cd'          ] = $this->orderinfolist->delivery_pref_cd          ;
		$datList['delivery_add1'             ] = $this->orderinfolist->delivery_add1             ;
		$datList['delivery_add2'             ] = $this->orderinfolist->delivery_add2             ;
		$datList['delivery_add3'             ] = $this->orderinfolist->delivery_add3             ;
		$datList['delivery_name_of_charge'   ] = $this->orderinfolist->delivery_name_of_charge   ;
		$datList['delivery_tel1'             ] = $this->orderinfolist->delivery_tel1             ;
		$datList['delivery_tel2'             ] = $this->orderinfolist->delivery_tel2             ;
		$datList['delivery_tel3'             ] = $this->orderinfolist->delivery_tel3             ;
		$datList['delivery_fax1'             ] = $this->orderinfolist->delivery_fax1             ;
		$datList['delivery_fax2'             ] = $this->orderinfolist->delivery_fax2             ;
		$datList['delivery_fax3'             ] = $this->orderinfolist->delivery_fax3             ;
		$datList['regist_name'               ] = $this->orderinfolist->regist_name               ;
		$datList['regist_kana'               ] = $this->orderinfolist->regist_kana               ;
		$datList['regist_zip1'               ] = $this->orderinfolist->regist_zip1               ;
		$datList['regist_zip2'               ] = $this->orderinfolist->regist_zip2               ;
		$datList['regist_pref'               ] = $this->orderinfolist->regist_pref               ;
		$datList['regist_pref_cd'            ] = $this->orderinfolist->regist_pref_cd            ;
		$datList['regist_add1'               ] = $this->orderinfolist->regist_add1               ;
		$datList['regist_add2'               ] = $this->orderinfolist->regist_add2               ;
		$datList['regist_add3'               ] = $this->orderinfolist->regist_add3               ;
		$datList['regist_ceo'                ] = $this->orderinfolist->regist_ceo                ;
		$datList['regist_ceo_kana'           ] = $this->orderinfolist->regist_ceo_kana           ;
		$datList['regist_name_of_charge'     ] = $this->orderinfolist->regist_name_of_charge     ;
		$datList['regist_name_of_charge_kana'] = $this->orderinfolist->regist_name_of_charge_kana;
		$datList['regist_tel1'               ] = $this->orderinfolist->regist_tel1               ;
		$datList['regist_tel2'               ] = $this->orderinfolist->regist_tel2               ;
		$datList['regist_tel3'               ] = $this->orderinfolist->regist_tel3               ;
		$datList['regist_contact_tel1'       ] = $this->orderinfolist->regist_contact_tel1       ;
		$datList['regist_contact_tel2'       ] = $this->orderinfolist->regist_contact_tel2       ;
		$datList['regist_contact_tel3'       ] = $this->orderinfolist->regist_contact_tel3       ;
		$datList['regist_contact_fax1'       ] = $this->orderinfolist->regist_contact_fax1       ;
		$datList['regist_contact_fax2'       ] = $this->orderinfolist->regist_contact_fax2       ;
		$datList['regist_contact_fax3'       ] = $this->orderinfolist->regist_contact_fax3       ;
		$datList['regist_mail'               ] = $this->orderinfolist->regist_mail               ;
		$datList['regist_url'                ] = $this->orderinfolist->regist_url                ;

		$datList['disable_upgrade'           ] = $this->orderinfolist->disable_upgrade           ;

		return $datList;
	}


}
