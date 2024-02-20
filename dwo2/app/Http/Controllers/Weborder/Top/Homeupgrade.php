<?php
/**
 *  Weborder/Top/Home.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_top_homeフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderTopHomeupgrade extends Dwo_ActionForm
{
    /** @var    bool    バリデータにプラグインを使うフラグ */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   フォーム値定義
     */
    var $form = array(
        'cust_id' => array(
            // フォームの定義
            'type'          => VAR_TYPE_INT,    // 入力値型
            'name'          => '使用者のお客様番号',      // 表示名
            'required'      => true,            // 必須オプション(true/false)
			'required_error'=> '使用者のお客様番号を数字で正しく入力してください',
			'type_error'    => '使用者のお客様番号で正しく入力してください',
        ),
        
        'basic_item_cd' => array(
        	'type'          => VAR_TYPE_STRING,    // 入力値型
            'name'          => '購入商品ベーシックCD',      // 表示名
            'required'      => true,            // 必須オプション(true/false)
			'required_error'=> '',
			'type_error'    => '',
        ),
    );
    
    
}

/**
 *  weborder_top_homeアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderTopHomeupgrade extends Dwo_ActionClass
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
     *  weborder_top_homeアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_top_homeアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {

		$month_num = $this->session->get("month_num");

		// メニュー設定
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("home");
		$basic_item_cd = $this->af->get("basic_item_cd");
		$this->af->set("basic_item_cd",$basic_item_cd);
		// 与信データ取得(再セット)
		$creditinfomanager = new CreditInfoManager();
		$creditinfo = $creditinfomanager->GetCreditData($this->session);
		$this->session->set("keep_creditinfo", $creditinfo->toArray());
		$basic_item_cd = $this->session->get("basic_item_cd");
		$soft_name = $this->session->get("soft_name");
		// echo "basic_item_cd: $basic_item_cd $soft_name";
        return 'weborder_top_homeupgrade';
    }
}
?>