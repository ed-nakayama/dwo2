<?php
/**
 *  Weborder/PapconfirmDo.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_papconfirm_doフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderPapconfirmDo extends Dwo_ActionForm
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

        'pap_acc_num' => array(
            // フォームの定義
            'type'          => VAR_TYPE_INT,    // 入力値型
            'name'          => 'PAP会員番号',      // 表示名
            'required'      => true,            // 必須オプション(true/false)
			'required_error'=> '指定した番号の会員は見つからないか、現在無効です。',
			'type_error'    => '指定した番号の会員は見つからないか、現在無効です。',
        ),
    );
}

/**
 *  weborder_papconfirm_doアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderPapconfirmDo extends Dwo_ActionClass
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
     *  weborder_papconfirm_doアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
		if ($this->af->validate() > 0) {
			return 'weborder_papinput';
		}
        return null;
    }

    /**
     *  weborder_papconfirm_doアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
		// メニュー設定
		$menumanager = new MenuManager($this);
		$menumanager->setMenu("home");

		$pap_acc_num = $this->af->get("pap_acc_num");
		$mlicensedao = new MLicenseDAO();
		$mlicense = $mlicensedao->find($pap_acc_num);
		if ($mlicense->custNum == "") {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']の会員は見つからないか、現在無効です。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}

		// 顧客情報検索
		$agentviewDAO = new AgentViewDAO();
		$agentviewDAO->pap_only = TRUE; // PAPのみ
		$agentview = $agentviewDAO->findById($mlicense->custNum);
		if ($agentview->custCode == "") {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']の会員は見つからないか、現在無効です。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}

		$this->session->set("keep_OriconPapAgent", $agentview->toArray());

        return 'weborder_top_home';
    }
}
?>
