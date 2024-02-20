<?php
/**
 *  Weborder/Dfupgrade.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_dfupgradeフォームの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderDfupgrade extends Dwo_ActionForm
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

        'cust_id' => array(
            // フォームの定義
            'type'          => VAR_TYPE_INT,    // 入力値型
            'name'          => '使用者のお客様番号',      // 表示名
            'required'      => true,            // 必須オプション(true/false)
			'required_error'=> '使用者のお客様番号を数字で正しく入力してください',
			'type_error'    => '使用者のお客様番号で正しく入力してください',
        ),
        
        'cust_tel' => array(
        	'type'          => VAR_TYPE_STRING,    // 入力値型
            'name'          => '使用者の電話番号',      // 表示名
            'required'      => true,            // 必須オプション(true/false)
			'required_error'=> '使用者の電話番号を数字で正しく入力してください',
			'type_error'    => '使用者の電話番号で正しく入力してください',
        ),

    );
}

/**
 *  weborder_dfupgradeアクションの実装
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderDfupgrade extends Dwo_ActionClass
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
     *  weborder_dfupgradeアクションの前処理
     *
     *  @access public
     *  @return string      遷移名(正常終了ならnull, 処理終了ならfalse)
     */
    function prepare()
    {
		if ($this->af->validate() > 0) {
			return 'weborder_dfupgrade';
		}
        return null;
    }

    /**
     *  weborder_dfupgradeアクションの実装
     *
     *  @access public
     *  @return string  遷移名
     */
    function perform()
    {
    	// PAP_IDがまだ確認してない
		$cust_id = trim($this->af->get("cust_id"));
		$cust_tel = trim($this->af->get("cust_tel"));
		$cust_tel = str_replace("-", "", $cust_tel);
		echo $cust_tel;
		
		//$packagedao = new PackageDAO();
		//$packagedao = $packagedao->find($cust_id,$cust_tel);

		$mlicensedao = new MLicenseDAO();
		$mlicense = $mlicensedao->find($cust_id);
		$serial_seq_num = $mlicense->serialSeqNum;
		$itemdao = new MSerial();
		$custinfo = new CustDAO();
		echo $mlicense->custNum;
		$custinfo = $custinfo->findtel($mlicense->custNum);
		$tel = $custinfo->searchtel;
		$mserial = new MSerialDAO();
		$mserial = $mserial->find($cust_id, $serial_seq_num);
		$item_cd = $mserial->itemCd;
		print_r($mserial);		
		echo $item_cd;
		$mitem = new MItemDAO();
		$mitem = $mitem->find($item_cd);
		$item_name = $mitem->itemName;
		$basic_item_cd = $mitem->basicitemCd;
		echo $item_name;
		echo $basic_item_cd;
		$support = new SupportDAO();
		$support = $support->findLast($cust_id,$serial_seq_num);
		echo "\n";
		echo $support->end_date;
		$end_date = $support->end_date;
		$support_type = $support->support_type;
		$support_plan = $support->support_plan;
		$plan_name = array("セルフサポート","ベーシックサポート","トータルサポート");
		$plan_num  = array(1,20,30);
		$type_name = array("無償","有償");
		$type_num  = array(0,1);
		$support_plan = str_replace($plan_num, $plan_name, $support_plan);
		$support_type = str_replace($type_num, $type_name, $support_type);
		if ( $tel != $cust_tel) {
			$res = Ethna::raiseNotice('指定した使用者の電話番号['.$cust_id.']は見つかりません。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		} else {
			$this->af->set("customer",$custinfo->name);
			$this->af->set("itemname",$item_name);
			$this->af->set("supportplan",$support_plan);
			$this->af->set("enddate",$end_date);
			$this->af->set("supporttype",$support_type);
			return 'weborder_customerinfo';	
		}
		
		
		/*	// 顧客情報検索
		$agentviewDAO = new AgentViewDAO();
		$agentviewDAO->pap_only = TRUE; // PAPのみ
		$agentview = $agentviewDAO->findById($mlicense->custNum);
		if ($agentview->custCode == "") {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']の会員は見つからないか、現在無効です。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		}

		// サポート開始日、終了日のチェック
		$supportdao = new SupportDAO();
		$support = $supportdao->findLast($agentview->accountNum, $agentview->supportSeqNum);
		// データ取得チェック
		if (($support->account_num == "") || ($support->end_date=="")) {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']の会員情報が正しく登録されていません。(サポート登録)', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		}
		// 日付判定
		$now = date("Ymd");
		if ($now > $support->end_date) {
			$res = Ethna::raiseNotice('指定した番号['.$pap_acc_num.']はサポート期間外のため使用できません。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		}
		*/
		//$this->af->setApp("OriconPap", $agentview->toArray());
    }
}
?>