<?php

namespace App\Http\Controllers\Classes;

class OrderInfo {
	var $cust_kbn                  ; // DWO専用顧客区分 "OR"(オリコン・ＴＭ), "PAP", "GOLD"(PAPゴールド), "YBP"の4パターン
	var $pap_order                 ; // 購入パターン Boolean: True=PAP製品、False=一般製品
	var $upgrade_order             ; // 
	var $syonin_mail_flg           ; // 承認メール有無 1:有
	var $cust_regist_flg           ; // お客様情報登録有無 1:有
	var $direct_delivery_type      ; // 直送区分 0:しない 1:する 直送(別途納品先)ならば伝票送付なし
	
	var $frm_cust_order_num        ; // 貴社発注No. [20桁]アップグレード用
	var $order_tantou_name         ; // 貴社ご発注　担当者 [14桁]
	var $double_package_type       ; // サプライ二重梱包
	var $remarks                   ; // 備考 [32桁]

	var $delivery_cust_code        ; // 納品先 顧客コード
	var $delivery_seq              ; // 納品先 シーケンス
	var $delivery_name             ; // 納品先 顧客名
	var $delivery_zip              ; // 納品先 郵便番号
	var $delivery_pref             ; // 納品先 県
	var $delivery_pref_cd          ; // 納品先 県コード
	var $delivery_add1             ; // 納品先 住所1
	var $delivery_add2             ; // 納品先 住所2
	var $delivery_add3             ; // 納品先 住所3
	var $delivery_name_of_charge   ; // 納品先 担当者
	var $delivery_tel1             ; // 納品先 電話番号
	var $delivery_tel2             ; // 納品先 電話番号
	var $delivery_tel3             ; // 納品先 電話番号
	var $delivery_fax1             ; // 納品先 FAX番号
	var $delivery_fax2             ; // 納品先 FAX番号
	var $delivery_fax3             ; // 納品先 FAX番号
	var $regist_name               ; // 登録名義*[25文字]
	var $regist_kana               ; // 登録名義(カタカナ)*[半角]
	var $regist_zip1               ; // 郵便番号1*
	var $regist_zip2               ; // 郵便番号2*
	var $regist_pref               ; // 県
	var $regist_pref_cd            ; // 県コード
	var $regist_add1               ; // 都道府県市区町村*[25文字]
	var $regist_add2               ; // 丁番地*[25文字]
	var $regist_add3               ; // 建物名[25文字]
	var $regist_ceo                ; // 代表者取締役または代表者[10文字]
	var $regist_ceo_kana           ; // 代表者取締役または代表者(カタカナ)[半角]
	var $regist_name_of_charge     ; // 担当者名[10文字]
	var $regist_name_of_charge_kana; // 担当者名(カタカナ)[半角]
	var $regist_tel1               ; // 登録電話番号*[半角]
	var $regist_tel2               ; // 登録電話番号*[半角]
	var $regist_tel3               ; // 登録電話番号*[半角]
	var $regist_contact_tel1       ; // 連絡先電話番号[半角]
	var $regist_contact_tel2       ; // 連絡先電話番号[半角]
	var $regist_contact_tel3       ; // 連絡先電話番号[半角]
	var $regist_contact_fax1       ; // 連絡先FAX番号[半角]
	var $regist_contact_fax2       ; // 連絡先FAX番号[半角]
	var $regist_contact_fax3       ; // 連絡先FAX番号[半角]
	var $regist_mail               ; // メールアドレス*[半角]
	var $regist_url                ; // ホームページURL[半角]

	var $disable_upgrade           ; // アップグレードなしフラグ　1：なし

}
