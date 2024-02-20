<?php
/**
 *  Weborder/Custinfo/UpgradeInpDo.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_custinfo_upgradeinp_doフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderCustinfoUpgradeInpDo extends Dwo_ActionForm
{
    /** @var    bool    バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   フォーム値定義
     */
    var $form = array(
        /*
        'sample' => array(
            // フォームの定義
            'type'          => VAR_TYPE_INT,    // 入力値型
            'form_type'     => FORM_TYPE_TEXT,  // フォーム型
            'name'          => 'サンプル',      // 表示名

            // バリデータ(記述順にバリデータが実行されます)
            'required'      => true,            // 必須オプション(true/false)
            'min'           => null,            // 最小値
            'max'           => null,            // 最大値
            'regexp'        => null,            // 文字種指定(正規表現)

            // フィルタ
            'filter'        => null,            // 入力値変換フィルタオプション
        ),
        */
/*
          'frm_regist_name' => array(
                    'name' =>'登録名義',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'required_error'=> '登録名義を入力して下さい。',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_kana' => array(
                    'name' =>'登録名義(カタカナ)',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'required_error'=> '登録名義(カタカナ)を入力して下さい。',
                    'filter' => 'han2zenCommaQuate',
                    ),
*/
          'frm_regist_zip1' => array(
                    'name' =>'郵便番号1',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'type_error'    => '郵便番号1は数値を入力して下さい。',
                    'required_error'=> '郵便番号1を入力して下さい。',
                    ),
          'frm_regist_zip2' => array(
                    'name' =>'郵便番号2',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'type_error'    => '郵便番号2は数値を入力して下さい。',
                    'required_error'=> '郵便番号2を入力して下さい。',
                    ),
          'frm_regist_pref_cd' => array(
                    'name' =>'都道府県',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'required_error'=> '都道府県を指定して下さい。',
                    ),
          'frm_regist_pref' => array(
                    'name' =>'都道府県名',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    ),
          'frm_regist_add1' => array(
                    'name' =>'都道府県市区町村',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'required_error'=> '都道府県市区町村を入力して下さい。',
                    'max' => 32,
                    'max_error'=> '都道府県市区町村は全角16文字以内で入力してください。',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_add2' => array(
                    'name' =>'丁番地',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'required_error'=> '丁番地を入力して下さい。',
                    'max' => 40,
                    'max_error'=> '丁番地は全角20文字以内で入力してください。',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_add3' => array(
                    'name' =>'建物名',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'max' => 40,
                    'max_error'=> '建物名は全角20文字以内で入力してください。',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_ceo' => array(
                    'name' =>'代表者取締役または代表者',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_ceo_kana' => array(
                    'name' =>'代表者取締役または代表者(カタカナ)',
                    'type' => VAR_TYPE_STRING,
                    'custom'    => 'checkKanji',
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_name_of_charge' => array(
                    'name' =>'担当者名',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_name_of_charge_kana' => array(
                    'name' =>'担当者名(カタカナ)',
                    'type' => VAR_TYPE_STRING,
                    'custom'    => 'checkKanji',
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_tel1' => array(
                    'name' =>'登録電話番号1',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'required_error'=> '登録電話番号1を入力して下さい。',
                    'type_error'    => '登録電話番号1は数値で入力して下さい。',
                    ),
          'frm_regist_tel2' => array(
                    'name' =>'登録電話番号2',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'required_error'=> '登録電話番号2を入力して下さい。',
                    'type_error'    => '登録電話番号2は数値で入力して下さい。',
                    ),
          'frm_regist_tel3' => array(
                    'name' =>'登録電話番号3',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'required_error'=> '登録電話番号3を入力して下さい。',
                    'type_error'    => '登録電話番号3は数値で入力して下さい。',
                    ),
          'frm_regist_contact_tel1' => array(
                    'name' =>'連絡先電話番号1',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '連絡先電話番号1は数値で入力して下さい。',
                    ),
          'frm_regist_contact_tel2' => array(
                    'name' =>'連絡先電話番号2',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '連絡先電話番号2は数値で入力して下さい。',
                    ),
          'frm_regist_contact_tel3' => array(
                    'name' =>'連絡先電話番号3',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '連絡先電話番号3は数値で入力して下さい。',
                    ),
          'frm_regist_contact_fax1' => array(
                    'name' =>'連絡先FAX番号1',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '連絡先FAX番号1は数値で入力して下さい。',
                    ),
          'frm_regist_contact_fax2' => array(
                    'name' =>'連絡先FAX番号2',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '連絡先FAX番号2は数値で入力して下さい。',
                    ),
          'frm_regist_contact_fax3' => array(
                    'name' =>'連絡先FAX番号3',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '連絡先FAX番号3は数値で入力して下さい。',
                    ),
          'frm_regist_mail' => array(
                    'name' =>'メールアドレス',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'custom' => 'checkMailaddress',
                    'type_error'    => 'メールアドレスを正しく入力して下さい。',
                    ),
          'frm_regist_mail_chk' => array(
                    'name' =>'メールアドレス確認',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'custom' => 'checkMailaddress',
                    'type_error'    => 'メールアドレス確認を正しく入力して下さい。',
                    ),
          'frm_regist_url' => array(
                    'name' =>'ホームページURL',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    ),
    );
   
     /**
	 * 漢字チェック
	 *
	 * @access public
	 * @param  string  $name   フォーム項目名
	 */
	function checkKanji($name) {
		$valStr = $this->form_vars[$name];	
		if($valStr != ''){
			mb_regex_encoding('cp932');
			if (mb_ereg('[亜-熙]+',$valStr)) {
				$this->ae->add($name, "{form}に漢字は使用できません。", E_FORM_INVALIDVALUE);
			} else if (!mb_ereg('^[ァ-ヶー]+$',$valStr)) {
				$this->ae->add($name, "{form}には全角カタカナのみを入力して下さい。", E_FORM_INVALIDVALUE);
			}
		}
	}
  
}

/**
 *  weborder_custinfo_upgradeinp_doアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderCustinfoUpgradeInpDo extends Dwo_ActionClass
{
    /**
     *  セッションチェック
     */
	function authenticate()
	{
		if ( !$this->session->isStart() ) {
			return 'weborder_login';
		}
	}

    /**
     *  weborder_custinfo_upgradeinp_doアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
		// メニュー設定
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("custinfo");
		$error_flag = FALSE;

		// オリコン・TM以外はメアド必須チェック
		$this->session->start();
		$orderinfosession = new UpgradeOrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();
		// メアド必須判定のためにオリコンかどうかの顧客区分をセットしておく
		$this->af->set("chk_cust_kbn" , $orderinfo->cust_kbn);

		// 下記バリデーションエラー発生時でも納品先コピーが機能するように
		$this->af->setApp("forCpOrderinfo", $orderinfosession->toArray());

		// バリデーションチェック
	   	if ($this->af->validate() > 0) {
			if ($orderinfo->cust_kbn != "OR") {
				// メールアドレスカスタムチェックに対するEUCエラーメッセージ出力を書き換え
				if ($this->ae->getMessage('frm_regist_mail') != "") {
					$this->ae->clear();
					$res = Ethna::raiseNotice('メールアドレスを正しく入力して下さい。', E_DWO_SYSERROR );
					$this->ae->addObject(null, $res);
					$error_flag = TRUE;
				}
				
				if ($this->ae->getMessage('frm_regist_mail_chk') != "") {
					$this->ae->clear();
					$res = Ethna::raiseNotice('メールアドレス確認を正しく入力して下さい。', E_DWO_SYSERROR );
					$this->ae->addObject(null, $res);
					$error_flag = TRUE;
				}
			}
			$error_flag = TRUE;
		}

		// メールアドレスチェック
		if ($this->af->get('frm_regist_mail') != $this->af->get('frm_regist_mail_chk')) {
			$this->ae->clear();
			$res = Ethna::raiseNotice('メールアドレス確認にはメールアドレスと同じものを入力してください。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			$error_flag = TRUE;
		}
		
		if($error_flag){
			$this->af->set("frm_regist_name",$orderinfo->regist_name);
			$this->af->set("frm_regist_kana",$orderinfo->regist_kana);
			return 'weborder_custinfo_upgradeinp';
		}
        return null;
    }

    /**
     *  weborder_custinfo_upgradeinp_doアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		// メニュー設定
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("orderconfirm");
		$this->session->start();
		$orderinfosession = new UpgradeOrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();

		$orderinfo->regist_zip1                = $this->af->get("frm_regist_zip1"               );
		$orderinfo->regist_zip2                = $this->af->get("frm_regist_zip2"               );
		$orderinfo->regist_pref_cd             = $this->af->get("frm_regist_pref_cd"            );
		$orderinfo->regist_pref                = $this->af->get("frm_regist_pref"               );
		$orderinfo->regist_add1                = $this->af->get("frm_regist_add1"               );
		$orderinfo->regist_add2                = $this->af->get("frm_regist_add2"               );
		$orderinfo->regist_add3                = $this->af->get("frm_regist_add3"               );
//		$orderinfo->regist_ceo                 = $this->af->get("frm_regist_ceo"                );
//		$orderinfo->regist_ceo_kana            = $this->af->get("frm_regist_ceo_kana"           );
		$orderinfo->regist_name_of_charge      = $this->af->get("frm_regist_name_of_charge"     );
		$orderinfo->regist_name_of_charge_kana = $this->af->get("frm_regist_name_of_charge_kana");
		$orderinfo->regist_tel1                = $this->af->get("frm_regist_tel1"               );
		$orderinfo->regist_tel2                = $this->af->get("frm_regist_tel2"               );
		$orderinfo->regist_tel3                = $this->af->get("frm_regist_tel3"               );
		$orderinfo->regist_contact_tel1        = $this->af->get("frm_regist_contact_tel1"       );
		$orderinfo->regist_contact_tel2        = $this->af->get("frm_regist_contact_tel2"       );
		$orderinfo->regist_contact_tel3        = $this->af->get("frm_regist_contact_tel3"       );
		$orderinfo->regist_contact_fax1        = $this->af->get("frm_regist_contact_fax1"       );
		$orderinfo->regist_contact_fax2        = $this->af->get("frm_regist_contact_fax2"       );
		$orderinfo->regist_contact_fax3        = $this->af->get("frm_regist_contact_fax3"       );
		$orderinfo->syonin_mail_flg            = 1 											 ; //いつも記入したメールへ送る
		$orderinfo->regist_mail                = $this->af->get("frm_regist_mail"               );
		$orderinfo->regist_mail_chk            = $this->af->get("frm_regist_mail_chk"           );
		$orderinfo->regist_url                 = $this->af->get("frm_regist_url"                );

		// 全角変換
		$mbconvutil = new MbConvUtil();
//		$orderinfo->regist_name                = $mbconvutil->convert($orderinfo->regist_name               );
//		$orderinfo->regist_kana                = $mbconvutil->convert($orderinfo->regist_kana               );
		$orderinfo->regist_add1                = $mbconvutil->convert($orderinfo->regist_add1               );
		$orderinfo->regist_add2                = $mbconvutil->convert($orderinfo->regist_add2               );
		$orderinfo->regist_add3                = $mbconvutil->convert($orderinfo->regist_add3               );
//		$orderinfo->regist_ceo                 = $mbconvutil->convert($orderinfo->regist_ceo                );
//		$orderinfo->regist_ceo_kana            = $mbconvutil->convert($orderinfo->regist_ceo_kana           );
		$orderinfo->regist_name_of_charge      = $mbconvutil->convert($orderinfo->regist_name_of_charge     );
		$orderinfo->regist_name_of_charge_kana = $mbconvutil->convert($orderinfo->regist_name_of_charge_kana);

		$orderinfosession->set($orderinfo);
		
		// 受注情報セット
		$this->af->setApp("orderinfo", $orderinfosession->toArray());
				
		//カートへ商品を入れる
		
		$DwoBasket = array();
		// Levan basic_item_cd -> second_total_sp_item_cd
		// $DwoBasket[0]['product_code'       ] = $this->session->get("basic_item_cd");
		$DwoBasket[0]['product_code'       ] = $this->session->get("second_total_sp_item_cd");
		$DwoBasket[0]['item_name_kanji'    ] = $this->session->get("soft_name");
		$DwoBasket[0]['base_name'          ];
		$DwoBasket[0]['count'              ]= 1 ;
		$DwoBasket[0]['status'             ];
		$DwoBasket[0]['sales_price'        ] = $this->session->get("upgrade_sale_price");
		$DwoBasket[0]['price_invoice_price'] = $this->session->get("upgrade_price");
		$DwoBasket[0]['cust_order_num'     ] = $this->session->get("cust_order_num");
		$DwoBasket[0]['item_class_large'   ] = $this->session->get("upgrade_item_large");
		$DwoBasket[0]['item_class_medium']   = $this->session->get("upgrade_item_medium");
		$DwoBasket[0]['item_ship_date'];
		$DwoBasket[0]['support_code'       ];
		$DwoBasket[0]['support_price'      ];
		$DwoBasket[0]['sup_item_name'      ];
		$DwoBasket[0]['support_base_price' ];
		
		$this->session->set("DwoBasket",$DwoBasket);
		$basketsession = new BasketSession($this->session);

		// 下記テンプレはお客様登録がない場合は別のアクション(Order/Confirm)からCALLされることに注意
        return 'weborder_order_upgradeconfirm';
    }

}
?>
