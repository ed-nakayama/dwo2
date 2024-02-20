<?php
/**
 *  Weborder/Test.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_Testフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderTest extends Dwo_ActionForm
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
 *  weborder_Testアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderTest extends Dwo_ActionClass
{
    /**
     *  weborder_Testアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_Testアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		$calendarmtdao = new CalendarMtDAO();
		$arr_date['year'] = date("Y");
		$arr_date['mon'] = date("m");
		$cal = $calendarmtdao->getCalendarDate($arr_date);

		$day = 0;
		$cancelDay = 0;
		$last_idx = strlen($cal) - 1;
print("last_idx=" . $last_idx . "<br>");
		for ($i = $last_idx; $i >= 0; $i--) {
print("cal[]=" . $cal[$i] . "<br>");
			if($cal[$i] == 1) {
				$cancelDay = $i;
				$day++;
			}

			if ($day == 2) break; // 月末最終営業日から３営業日前
		}
print("cancelDay=" . $cancelDay . "<br>");

        return 'weborder_top_condition';
    }
}
?>
