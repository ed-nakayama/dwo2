<?php
/**
 *  Weborder/Notfound.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_notfoundフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderNotfound extends Dwo_ActionForm
{
}

/**
 *  weborder_notfoundアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderNotfound extends Dwo_ActionClass
{
    /**
     *  weborder_notfoundアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_notfoundアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
    	header("HTTP/1.0 403 Forbidden");
        return 'weborder_notfound-forbidden';
    }
}
?>
