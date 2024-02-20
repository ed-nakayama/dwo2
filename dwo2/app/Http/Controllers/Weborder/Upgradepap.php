<?php
/**
 *  Weborder/Upgradepap.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_dfupgrade�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderUpgradepap extends Dwo_ActionForm
{
    /** @var    bool    �o���f�[�^�Ƀv���O�C�����g���t���O */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   �t�H�[���l��`
     */
    var $form = array(
        'cust_id' => array(
            // �t�H�[���̒�`
            'type'          => VAR_TYPE_INT,    // ���͒l�^
            'name'          => '�g�p�҂̂��q�l�ԍ�',      // �\����
            'required'      => true,            // �K�{�I�v�V����(true/false)
			'required_error'=> '�g�p�҂̂��q�l�ԍ��𐔎��Ő��������͂��Ă�������',
			'type_error'    => '�g�p�҂̂��q�l�ԍ��Ő��������͂��Ă�������',
        ),
        
        'cust_tel' => array(
        	'type'          => VAR_TYPE_STRING,    // ���͒l�^
            'name'          => '�g�p�҂̓d�b�ԍ�',      // �\����
            'required'      => true,            // �K�{�I�v�V����(true/false)
			'required_error'=> '�g�p�҂̓d�b�ԍ��𐔎��Ő��������͂��Ă�������',
			'type_error'    => '�g�p�҂̓d�b�ԍ��Ő��������͂��Ă�������',
        ),

    );
}

/**
 *  weborder_dfupgrade�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderUpgradepap extends Dwo_ActionClass
{
    /**
     *  �Z�b�V�����`�F�b�N
     */
	function authenticate()
	{
		if ( !$this->session->isStart() ) {
			return 'weborder_login';
		}
	}

    /**
     *  weborder_dfupgrade�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
		if ($this->af->validate() > 0) {
			return 'weborder_upgradepap';
		}
        return null;
    }

    /**
     *  weborder_dfupgrade�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
    	// PAP_ID���܂��m�F���ĂȂ�
		$cust_id = trim($this->af->get("cust_id"));
		$cust_tel = trim($this->af->get("cust_tel"));
		$cust_tel = str_replace("-", "", $cust_tel);
		echo $cust_tel;
		$mlicensedao = new MLicenseDAO();
		$mlicense = $mlicensedao->find($cust_id);
		if ($mlicense->custNum == NULL){
			echo "1\n";
			$res = Ethna::raiseNotice('�w�肵���g�p�҂͌�����܂���B', E_DWO_SYSERROR );
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
			$mserial = $mserial->find($cust_id, $serial_seq_num); // ���v�ł����H���̕ϐ�
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
				$res = Ethna::raiseNotice('�w�肵���g�p�҂͌�����܂���B', E_DWO_SYSERROR );
				$this->ae->addObject(null, $res);
				return 'weborder_upgradepap';
			}*/
			$now_y = date("Y");
			$now_m = date("m");
			$end_date = $support->end_date;
			$end_y = substr($end_date,0,4);
			$end_m = substr($end_date,4,2);
			$end_d = substr($end_date,6,2);
	 		$deadline = $end_y."�N".$end_m."��".$end_d."��";
	 		$month_num = (INT)(($end_y-$now_y)*12 + ($end_m-$now_m));
	 		echo $month_num;
			$support_type = $support->support_type;
			$support_plan = $support->support_plan;
			$plan_name = array("�Z���t�T�|�[�g","�x�[�V�b�N�T�|�[�g","�g�[�^���T�|�[�g");
			$plan_num  = array(1,20,30);
			$type_name = array("����","�L��");
			$type_num  = array(0,1);
			$support_plan = str_replace($plan_num, $plan_name, $support_plan);
			$support_type = str_replace($type_num, $type_name, $support_type);
			if ( $tel != $cust_tel) {
				echo "3\n";
				$res = Ethna::raiseNotice('�w�肵���g�p�҂͌�����܂���B', E_DWO_SYSERROR );
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
		/*	// �ڋq��񌟍�
		$agentviewDAO = new AgentViewDAO();
		$agentviewDAO->pap_only = TRUE; // PAP�̂�
		$agentview = $agentviewDAO->findById($mlicense->custNum);
		if ($agentview->custCode == "") {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̉���͌�����Ȃ����A���ݖ����ł��B', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		}

		// �T�|�[�g�J�n���A�I�����̃`�F�b�N
		$supportdao = new SupportDAO();
		$support = $supportdao->findLast($agentview->accountNum, $agentview->supportSeqNum);
		// �f�[�^�擾�`�F�b�N
		if (($support->account_num == "") || ($support->end_date=="")) {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̉����񂪐������o�^����Ă��܂���B(�T�|�[�g�o�^)', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		}
		// ���t����
		$now = date("Ymd");
		if ($now > $support->end_date) {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̓T�|�[�g���ԊO�̂��ߎg�p�ł��܂���B', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_dfupgrade';
		}
		*/
		//$this->af->setApp("OriconPap", $agentview->toArray());
    }
}
?>