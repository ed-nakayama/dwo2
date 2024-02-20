<?php
/**
 *  Weborder/Upgradepap.php
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
class Dwo_Form_WeborderUpgradepap extends Dwo_ActionForm
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
class Dwo_Action_WeborderUpgradepap extends Dwo_ActionClass
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
			return 'weborder_upgradepap';
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
		$mlicensedao = new MLicenseDAO();
		$mlicense = $mlicensedao->find($cust_id);
		if ($mlicense->custNum == NULL){
			echo "1\n";
			$res = Ethna::raiseNotice('指定した使用者は見つかりません。', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_upgradepap';
		} else {
			$serial_seq_num = $mlicense->serialSeqNum;
			$itemdao = new MSerial();
			$custinfo = new CustDAO();
	
			//echo $mlicense->custNum;
			$custinfo = $custinfo->findtel($mlicense->custNum);
			$tel = $custinfo->searchtel;
			$mserial = new MSerialDAO();
			$mserial = $mserial->find($cust_id, $serial_seq_num); // 大丈夫ですか？この変数
			$item_cd = $mserial->itemCd;
	
			// Search from M_ITEM table
			$mitem = new MItemDAO();
			$mitem = $mitem->findname($item_cd);
			$item_name = $mitem->itemName;
			$this->session->start();
			$agentAry = $this->session->get("agentAry");
			$custCode = $agentAry["custCode"];
			$support = new SupportDAO();
			$support = $support->findLast($cust_id,$serial_seq_num);//echo "\n";
			echo "<br>";
			echo $support->purchase_cust_num;
			/*if ($support->purchase_cust_num != $custCode){
				echo "2\n";
				$res = Ethna::raiseNotice('指定した使用者は見つかりません。', E_DWO_SYSERROR );
				$this->ae->addObject(null, $res);
				return 'weborder_upgradepap';
			}*/
			$now_y = date("Y");
			$now_m = date("m");
			$end_date = $support->end_date;
			$end_y = substr($end_date,0,4);
			$end_m = substr($end_date,4,2);
			$end_d = substr($end_date,6,2);
	 		$deadline = $end_y."年".$end_m."月".$end_d."日";
	 		$month_num = (INT)(($end_y-$now_y)*12 + ($end_m-$now_m));
	 		echo $month_num;
			$support_type = $support->support_type;
			$support_plan = $support->support_plan;
			$plan_name = array("セルフサポート","ベーシックサポート","トータルサポート");
			$plan_num  = array(1,20,30);
			$type_name = array("無償","有償");
			$type_num  = array(0,1);
			$support_plan = str_replace($plan_num, $plan_name, $support_plan);
			$support_type = str_replace($type_num, $type_name, $support_type);
			if ( $tel != $cust_tel) {
				echo "3\n";
				$res = Ethna::raiseNotice('指定した使用者は見つかりません。', E_DWO_SYSERROR );
				$this->ae->addObject(null, $res);
				return 'weborder_upgradepap';
			} else {
				$this->af->set("customer",$custinfo->name);
				$this->af->set("itemname",$item_name);
				$this->af->set("supportplan",$support_plan);
				$this->af->set("enddate",$deadline);
				$this->af->set("supporttype",$support_type);
				$this->af->set("basic_item_cd",$basic_item_cd);
				$this->af->set("item_cd",$item_cd);
				return 'weborder_upgradecust';	
			}
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