<?php
/**
 *  Weborder/Order/Upgrade.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_order_upgradeフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderOrderUpgradeconfirm extends Dwo_ActionForm
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
 *  weborder_order_upgradeアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderOrderUpgradeconfirm extends Dwo_ActionClass
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
     *  weborder_order_upgradeアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_order_upgradeアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		// メニュー設定
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("orderconfirm");
		$credit_flag = TRUE;

		$this->session->start();
		$upgradeorderinfosession = new UpgradeOrderInfoSession($this->session);
		$upgradeorderinfo = $upgradeorderinfosession->get();
		// 受注情報セット
		$this->af->setApp("orderinfo", $upgradeorderinfosession->toArray());
		
		// 下記テンプレはお客様登録がある場合はCustinfo/InputDoからCALLされることに注意。
        return 'weborder_order_upgradeconfirm';
    }
}
?>
