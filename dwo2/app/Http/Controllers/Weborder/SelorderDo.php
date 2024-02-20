<?php
/**
 *  Weborder/SelorderDo.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_selorder_doフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderSelorderDo extends Dwo_ActionForm
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
          'mode' => array(
                    'name' =>'購入方法',
                    'type' => VAR_TYPE_STRING,
					'required'      => true,
					'required_error' => '購入方法を選択してください',
                    ),
    );
}

/**
 *  weborder_selorder_doアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderSelorderDo extends Dwo_ActionClass
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
     *  weborder_selorder_doアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
	   	if ($this->af->validate() > 0) {
			return 'weborder_error';
   		}
        return null;
    }

    /**
     *  weborder_selorder_doアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		// セッション開始
    	$this->session->start();

		// バスケットはここでもクリアー(ブラウザの戻る対応)
		$basketsession = new BasketSession($this->session);
		$basketsession->clear();

		$orderinfosession = new OrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();

		if ($this->af->get("mode") == "pap") {
			$orderinfo->pap_order = TRUE;
		} else {
			$orderinfo->pap_order = FALSE;
		}
		if ($this->af->get("mode") == "upgrade") {
			$orderinfo->upgrade_order = TRUE;
		} else {
			$orderinfo->upgrade_order = FALSE;
		}
		// セッションに情報をセットし次のページへ
		$orderinfosession->set($orderinfo);
		$this->session->set("orderinfo", $orderinfosession->toArray());

		if ($orderinfo->cust_kbn == "OR")  {
			// オリコンの場合でモードがPAPオーダーの場合
			if ($orderinfo->pap_order == TRUE){ 
				return 'weborder_papinput';
			} 
			if ($orderinfo->upgrade_order == TRUE) {
				return 'weborder_upgrade';
			}  
			if (($orderinfo->pap_order == FALSE) || ($orderinfo->upgrade_order == FALSE)) { 
				// メニュー設定
				$menumanager = new MenuManager($this);
				$menumanager->setMenu("home");
				return 'weborder_top_home';
			}
		} else {
			if ($orderinfo->upgrade_order == TRUE) {
				return 'weborder_upgrade';
			} else {
				// メニュー設定
				$menumanager = new MenuManager($this);
				$menumanager->setMenu("home");
		        return 'weborder_top_home';
			}
		}
    }
}
?>