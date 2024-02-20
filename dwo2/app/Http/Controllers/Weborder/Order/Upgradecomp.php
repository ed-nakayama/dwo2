<?php
/**
 *  Weborder/Order/Upgradecomp.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_order_upgradecompフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderOrderUpgradeComp extends Dwo_ActionForm
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

          'frm_regist' => array(
                    'name' =>'オーダー確定',
                    'type' => VAR_TYPE_STRING,
					'required'      => false,
                    ),

    );
}

/**
 *  weborder_order_upgradecompアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */

class Dwo_Action_WeborderOrderUpgradeComp extends Dwo_ActionClass
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
     *  weborder_order_upgradecompアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_order_upgradecompアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		// メニュー設定
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenuComplete("complete");

		if ($this->af->get("frm_regist") == "EXEC") {
			// 登録、メール送信処理
			$orderregistmanager = new UpgradeOrderRegistManager($this);
			$basketsession = new BasketSession($this->session);
            $result = $orderregistmanager->RegistOrder();

			if (Ethna::isError($result)) {

/* 2008/05/19 メール送信エラーはロールバックしない。by nakayama
				$chk_orderSeqNum = $this->session->get("ORDER_SEQ_NO");
				if ($chk_orderSeqNum != "") { // 空の場合は登録処理前なのでロールバックの必要なし
					// DBロールバック
					$orderregistmanager->RegistRollback($chk_orderSeqNum);
				}
*/
				$this->ae->addObject(null, $result);
				return 'weborder_error';
			}

			// (２重登録防止用)
			// バスケット情報のクリア
			$basketsession = new BasketSession($this->session);
			$basketsession->clear();
			
			// オーダー情報のクリア
			$upgradeorderinfosession = new UpgradeOrderInfoSession($this->session);
			$upgradeorderinfosession->resetComplete(); // 必要な情報は残す
			
			$this->session->set("cust_order_num","");
			$this->session->set("order_tantou_name","");
			$this->session->set("remarks","");
		}

        return 'weborder_order_upgradecomp';
    }
}
?>
