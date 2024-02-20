<?php
/**
 *  Weborder/Custinfo/UpgradeInp.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_custinfo_upgradeinpフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderCustinfoUpgradeInp extends Dwo_ActionForm
{
    /** @var    bool    バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   フォーム値定義
     */
    var $form = array(
		'frm_cust_order_num' => array(
					'name'      => '貴社発注No',
					'form_type' => FORM_TYPE_TEXT,
					'type'      => VAR_TYPE_STRING,
					'required'  => false,
					'max'       => 20,
					'filter' => 'han2zenCommaQuate',
					),
		'frm_order_tantou_name' => array(
                    'name' =>'貴社ご発注 担当者',
                    'type' => VAR_TYPE_STRING,
					'required'      => false,
					'filter' => 'han2zenCommaQuate',
                    ),
        'frm_remarks' => array(
                    'name' =>'備考',
                    'type' => VAR_TYPE_STRING,
					'required'      => false,
					'filter' => 'han2zenCommaQuate',
                    ),        
    );
}

/**
 *  weborder_custinfo_upgradeinpアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderCustinfoUpgradeInp extends Dwo_ActionClass
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
     *  weborder_custinfo_upgradeinpアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
	   	if ($this->af->validate() > 0) {
//			return 'weborder_custinfo_upgradeinp';  // levan test for desize
			return 'weborder_order_upgradedetail';
		}
        return null;
    }

    /**
     *  weborder_custinfo_upgradeinpアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		// メニュー設定
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("custinfo");
		
        // メニューからCALLされた場合の考慮
		$this->session->start();
		$cust_num = $this->session->get("cust_num");
		
		$upgradeorderinfosession = new UpgradeOrderInfoSession($this->session);
		$upgradeorderinfo = $upgradeorderinfosession->get();
			
		$custdao = new CustDAO();
		$custinfo = $custdao->find_by_id($cust_num); 
		
		//元々の配達情報
		$upgradeorderinfo->delivery_cust_code = $custinfo->custCode ;
		$upgradeorderinfo->delivery_seq 	  = "1"                 ;
		$upgradeorderinfo->delivery_name      = $custinfo->personName  ;
		$upgradeorderinfo->delivery_zip		  = $custinfo->zip      ;
		$upgradeorderinfo->delivery_pref      = $custinfo->pref     ;
		$upgradeorderinfo->delivery_pref_cd   = $custinfo->prefcd   ;
		$upgradeorderinfo->delivery_add1      = $custinfo->address1 ;
		$upgradeorderinfo->delivery_add2      = $custinfo->address2 ;
		$upgradeorderinfo->delivery_add3      = $custinfo->address2 ;
		$upgradeorderinfo->delivery_name_of_charge = $custinfo->name;
		
		//Phone Processing
		$phone_number = split("-", $custinfo->tel,3);
		$upgradeorderinfo->delivery_tel1 = $phone_number[0];
		$upgradeorderinfo->delivery_tel2 = $phone_number[1];
		$upgradeorderinfo->delivery_tel3 = $phone_number[2];
		
		//Fax processing
		$fax_number   = split("-", $custinfo->fax,3);
		$upgradeorderinfo->delivery_fax1 = $fax_number[0];
		$upgradeorderinfo->delivery_fax2 = $fax_number[1];
		$upgradeorderinfo->delivery_fax3 = $fax_number[2];
		//登録名義
		$upgradeorderinfo->regist_name  = $custinfo->name;
		$upgradeorderinfo->regist_kana  = $custinfo->nameKana;
		
		//代表者
		$upgradeorderinfo->regist_ceo        = $custinfo->ceoname;
		$upgradeorderinfo->regist_ceo_kana   = $custinfo->ceonameKana;
		
		//登録電話番号の処理
		$telephone = split("-", $custinfo->tel,3);
		$upgradeorderinfo->regist_tel1 = $telephone[0];
		$upgradeorderinfo->regist_tel2 = $telephone[1];
		$upgradeorderinfo->regist_tel3 = $telephone[2];
		
		//備考・担当者 ・貴社発注
    	$upgradeorderinfo->cust_order_num    = $this->af->get("frm_cust_order_num");
		$upgradeorderinfo->order_tantou_name = $this->af->get("frm_order_tantou_name");
		
		if ($this->af->get("frm_remarks")!= ""){
			$upgradeorderinfo->remarks = $this->af->get("frm_remarks");
		} else {
			$upgradeorderinfo->remarks = $upgradeorderinfo->regist_name;
		}
		
		$this->session->set("cust_order_num",$upgradeorderinfo->cust_order_num);
		$this->session->set("order_tantou_name",$upgradeorderinfo->order_tantou_name);
		$this->session->set("remarks",$upgradeorderinfo->remarks);
		
		$this->af->set("frm_regist_name" , $upgradeorderinfo->regist_name);
		$this->af->set("frm_regist_kana" , $upgradeorderinfo->regist_kana);
		$this->af->set("frm_regist_tel1"  , $upgradeorderinfo->regist_tel1);
		$this->af->set("frm_regist_tel2"  , $upgradeorderinfo->regist_tel2);
		$this->af->set("frm_regist_tel3"  , $upgradeorderinfo->regist_tel3);
		$this->af->set("frm_regist_ceo" , $upgradeorderinfo->regist_ceo);
		$this->af->set("frm_regist_ceo_kana" , $upgradeorderinfo->regist_ceo_kana);
		
		// メアド必須判定のためにオリコンかどうかの顧客区分をセットしておく
		$this->af->set("chk_cust_kbn"                  , $upgradeorderinfo->cust_kbn);

		// 次回以降表示用としてセッションにセット 発注Noや備考などがセットされる
		$upgradeorderinfosession->set($upgradeorderinfo);
		$this->session->set("upgradeorderinfo", $upgradeorderinfosession->toArray());

		$preDAO = new PrefDAO();
		$preList = $preDAO->find();
		for ($i = 0; $i < $preList->size(); $i++) {
			$kdata = $preList->get($i);
			$kenList[$i]['code'] = $kdata->code;
			$kenList[$i]['name'] = $kdata->name;
		}
		$this->session->set("kenList" ,$kenList);

		$this->af->setApp("forCpOrderinfo", $upgradeorderinfosession->toArray());

        return 'weborder_custinfo_upgradeinp';
    }
}
?>
