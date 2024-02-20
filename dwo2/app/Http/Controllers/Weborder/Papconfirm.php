<?php
/**
 *  Weborder/Papconfirm.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_papconfirmフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderPapconfirm extends Dwo_ActionForm
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
			'required_error'=> 'PAP会員番号を数字で正しく入力してください',
			'type_error'    => 'PAP会員番号を数字で正しく入力してください',
        ),
    );
}

/**
 *  weborder_papconfirmアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderPapconfirm extends Dwo_ActionClass
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
     *  weborder_papconfirmアクションの前処理
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
     *  weborder_papconfirmアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
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

		// サポート開始日、終了日のチェック
		$supportdao = new SupportDAO();
		$support = $supportdao->findLast($agentview->accountNum, $agentview->supportSeqNum);
		// データ取得チェック
		if (($support->account_num == "") || ($support->end_date=="")) {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']の会員情報が正しく登録されていません。(サポート登録)', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}
		// 日付判定
		$now = date("Ymd");
		if ($now > $support->end_date) {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']はサポート期間外のため使用できません。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}

		// 弥生１３対応 2012/11/11
		$memberTypeName = '';
		$memberType = $agentview->getCustClassCode();
		if ($memberType == 'GOLD') {
			$memberTypeName = 'ゴールド会員';
		} else if ($memberType == 'PAP') {
			$memberTypeName = 'メンバー会員';
		}

		$this->session->set('memberType', $memberType);

		$this->af->setApp("memberTypeName" ,$memberTypeName);
		$this->af->setApp("OriconPap", $agentview->toArray());

        return 'weborder_papconfirm';
    }
}
?>