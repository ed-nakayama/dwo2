<?php
/**
 *  Weborder/Testtest.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_testtestフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderTesttest extends Dwo_ActionForm
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
    );
}

/**
 *  weborder_testtestアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderTesttest extends Dwo_ActionClass
{
    /**
     *  weborder_testtestアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_testtestアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
/*
		// 出荷日の取得呼び出し ---- ここから
		//$shippingdatedao = new ShippingDateDAO();
		$shippingdatedao = new CalendarMtDAO();
		$ship = $shippingdatedao->getShippingDate();
		// 出荷日の取得呼び出し ---- ここまで

		//$this->af->setApp("testship", $ship);
		$this->af->setApp("testship", "https://".SERVER_NAME.URL_DOC_ROOT."?xxx=aaa");
*/

		$dbgconvdao = new dbgConvDAO();
		$dbgconvdao->update();

        return 'weborder_testtest';
    }
}
?>
