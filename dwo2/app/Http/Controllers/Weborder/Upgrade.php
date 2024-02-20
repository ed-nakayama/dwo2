<?php
/**
 *  Weborder/Upgrade.php
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
class Dwo_Form_WeborderUpgrade extends Dwo_ActionForm
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
class Dwo_Action_WeborderUpgrade extends Dwo_ActionClass
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
			return 'weborder_upgrade';
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
    	$error_code  = 0;
    	$shopgroup2  = '';
    	$telephone   = '';
    	$support     = NULL;
    	$disagent    = FALSE;
    	$enable_flag = TRUE;
    	$second_flag = FALSE;
    	$cust_id = trim($this->af->get("cust_id"));
		$cust_tel = trim($this->af->get("cust_tel"));
		$cust_tel = str_replace("-", "", $cust_tel);
	
		// get basic item information
		$mlicensedao = new MLicenseDAO();
		$mlicense = $mlicensedao->find($cust_id);
		$serial_seq_num = $mlicense->serialSeqNum;
		$support_seq_num = $mlicense->supportSeqNum;
		$mserial = new MSerialDAO();
		$mserial = $mserial->find($cust_id, $serial_seq_num);
		$item_cd = $mserial->itemCd;

		// Search from M_ITEM table
		$mitemDAO = new MItemDAO();	//���i����Basic_item_cd�ŎQ�Ƃ���
		$mitem = $mitemDAO->findbybasic($item_cd);
		$item_name = $mitem->itemName;
		$soft_name = $item_name . " �T�|�[�g�v�����A�b�v�O���[�h";
		$second_sp_item_cd = $mitem->secondspitemCd;
		$second_total_sp_item_cd = $mitem->secondtotalspitemCd;
		$mitem = $mitemDAO->find($item_cd);
		$basic_item_cd = $mitem->basicitemCd;


		$supportItem = $mitemDAO->findbybasic($second_total_sp_item_cd);
		$upgrade_item_large = $supportItem->itemclassLarge;
		$upgrade_item_medium = $supportItem->itemclassMedium;
		$upgrade_item_small = $supportItem->itemclassSmall;



		//echo "basic_item_cd: " . $basic_item_cd . "  second_sp_item_cd: " . $second_sp_item_cd . "<BR>"; 
		//echo "license: " . $mlicense->custNum . "  serial: " . $serial_seq_num . 
		//	"  support: " . $support_seq_num . "<br>" ;

		// ���q�l�ԍ��Ƃ̓d�b�ԍ��̏ƍ� 
		if ($mlicense->custNum != NULL){
			$custdao = new CustDAO();	
			$custinfo = $custdao->find_by_id($mlicense->custNum);
			$cust_num = $mlicense->custNum;
			$telephone = $custinfo->searchtel;
			//���q�l�ԍ��Ɠd�b�ԍ��͈�v���Ȃ��ꍇ			
			if($telephone != $cust_tel) $error_code = 1;
			//echo "custtel: " . $cust_tel . "  tel: " . $telephone . "<br>" ;
		}else $error_code = 2;// ��舵���Ȃ��ꎟ�X�܂��͏��i
		
		// ۸޲ݓX�܂ƈꎟ�̔��X�̏ƍ�
		if(!$error_code){			
			$this->session->start();
			$agentAry = $this->session->get("agentAry");
			$custCode = $agentAry["custCode"];
			$support = new SupportDAO();
			$support = $support->findLast($cust_id,$support_seq_num);
			if($support->purchase_cust_num != $custCode) $error_code = 3;
		}
		
		// �T�[�{���擾�A�b�v�O���[�h�ΏۊO�̈ꎟ�E�񎟔̔��X�̊O��
		if(!$error_code){
			$first_acc_num = $support->purchase_cust_num;
			$second_acc_num = $support->secondary_cust_num;
			$support_type = $support->support_type;
			$this->session->set("support_type",$support_type); // Quang 2010/10/31
			$support_plan = $support->support_plan;
			$support_cust = $support->purchase_cust_num;
			$support_end  = $support->end_date;
			//echo "custCode: $custCode, ACC_NUM: $first_acc_num, $second_acc_num<br>";

			$mdisagentDAO = new DisagentDAO();
			if($support_cust == 3152004 || $support_cust == 3540028){
				$second_flag = TRUE; // ORICON �� YBP �̏ꍇ�͓񎟓X�t���O���Z�b�g
				if($second_acc_num != ''){
					$papinfo = $custdao->find_by_id($second_acc_num);
					$second_pap = $papinfo->name;
					$shopgroup2 = $papinfo->group2;
					$second_cust_num    = $papinfo->custCode;   //Quang 2010/11/01
					$second_account_num = $mlicensedao->get_pap_accnum($second_cust_num, "0"); //Quang 2010/11/01
				}else{	// ORICON/YBP �Ȃ̂ɓ񎟓X��񂪂���܂���B
				}
				$disagent = $mdisagentDAO->isDisable(2,$shopgroup2);
				//echo "shop_group(second shop): $shopgroup2 Disable=$disagent<br>" ;
			}else{
				$papinfo = $custdao->find_by_id($support_cust);
				$shopgroup2 = $papinfo->group2;
				$disagent = $mdisagentDAO->isDisable(1,$shopgroup2);
				//echo "shop_group(first shop): $shopgroup2 Disable=$disagent<br>" ;
			}
			if($disagent) $error_code = 4;	
		}

		if(!$error_code){						
			$support_endy = substr($support_end,0,4);
			$support_endm = substr($support_end,4,2);
			$support_endd = substr($support_end,6,2);
	 		$deadline = $support_endy."�N".$support_endm."��".$support_endd."��";		
			$now_month = intval(date("Y"))*12 + intval(date("m"));
			$end_month = intval($support_endy)*12 + intval($support_endm);
			$month_num = $end_month - $now_month;

			if ($month_num <= 2) {
				$error_code = 5; 
			}
			$arr_date['y']  = date('Y'); //���݂ɔN
			$arr_date['m']  = date('n'); //���݂̌�
			$arr_date['d']  = date('j'); //���݂̓�
			$arr_date['h']  = date('G'); //���݂̎���
			
			$now   = mktime($arr_date['h'] ,0,0,$arr_date['m'],$arr_date['d'],$arr_date['y']);
			$calendarmtdao = new CalendarMtDAO();
			$receipt_date = $calendarmtdao->getReceiptDate($now);
			if ($receipt_date == ""){
				$error_code = 6;
			}
			// �x�[�V�b�N�ȊO�̓A�b�v�O���[�h�s��
			if ($support_plan != 20) $enable_flag = FALSE;
	 		//echo "plan= $support_plan, type=$support_type months=$month_num<br>";

			$plan_name = array(10 => '�Z���t�T�|�[�g',20 => '�x�[�V�b�N�T�|�[�g',30 => '�g�[�^���T�|�[�g');
			$type_name = array(0 => '����',1 => '�L��');
			$support_plan = $plan_name[$support_plan];
			if ($support_type == "1" && $month_num >= "3" &&  $month_num <= "5") {
				$support_type_name = $type_name[0];
			} else {
				$support_type_name = $type_name[$support_type];
			}
		}

		if (!$error_code){		
			$this->session->start();
			$this->session->set("basic_item_cd",$basic_item_cd);
			$this->session->set("soft_name",$soft_name);
			$this->session->set("secondflag",$second_flag); //Quang 2010/11/01 
			$this->session->set("secondary_account_num",$second_account_num); //Quang 2010/11/01 
			$this->session->set("secondary_cust_num",$second_cust_num); //Quang 2010/11/01 
			$this->session->set("cust_id",$cust_id);
			$this->session->set("cust_num",$cust_num);
			$this->session->set("month_num",$month_num);
			$this->session->set("receipt_date",$receipt_date);
			$this->session->set("second_sp_item_cd",$second_sp_item_cd);
			$this->session->set("second_total_sp_item_cd",$second_total_sp_item_cd);
			$this->session->set("upgrade_item_large",$upgrade_item_large);
			$this->session->set("upgrade_item_medium",$upgrade_item_medium);
			$this->session->set("upgrade_item_small",$upgrade_item_small);
			$this->session->set("support_type",$support_type);
			
			$this->af->set("enableflag",$enable_flag);
			$this->af->set("secondflag",$second_flag);
			$this->af->set("secondpap",$second_pap);
			$this->af->set("customer", $custinfo->name);
			$this->af->set("itemname",$item_name);
			$this->af->set("supportplan",$support_plan);
			$this->af->set("enddate",$deadline);
			$this->af->set("monthnum",$month_num);
			$this->af->set("supporttype",$support_type_name);
			$this->af->set("item_cd",$item_cd);
			return 'weborder_upgradecust';	
		} else {
				 if($error_code == 6) $errstr = '���戵�ł��܂���i�R�[�h��6�j�B';
			else if($error_code == 5) $errstr = '���戵�ł��܂���i�R�[�h��5�j�B';
			else if($error_code == 4) $errstr = '���戵�ł��܂���i�R�[�h��4�j�B';
			else if($error_code == 3) $errstr = '���戵�ł��܂���i�R�[�h��3�j�B';
			else                      $errstr = '�w�肵���g�p�҂͌�����܂���i�R�[�h=' . $error_code . '�j�B';
			$res = Ethna::raiseNotice($errstr, E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_upgrade';
		}
    }
}
?>