<?php
/**
 *  Weborder/Custinfo/UpgradeInp.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_custinfo_upgradeinp�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderCustinfoUpgradeInp extends Dwo_ActionForm
{
    /** @var    bool    �o���f�[�^�Ƀv���O�C�����g���t���O */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   �t�H�[���l��`
     */
    var $form = array(
		'frm_cust_order_num' => array(
					'name'      => '�M�Д���No',
					'form_type' => FORM_TYPE_TEXT,
					'type'      => VAR_TYPE_STRING,
					'required'  => false,
					'max'       => 20,
					'filter' => 'han2zenCommaQuate',
					),
		'frm_order_tantou_name' => array(
                    'name' =>'�M�Ђ����� �S����',
                    'type' => VAR_TYPE_STRING,
					'required'      => false,
					'filter' => 'han2zenCommaQuate',
                    ),
        'frm_remarks' => array(
                    'name' =>'���l',
                    'type' => VAR_TYPE_STRING,
					'required'      => false,
					'filter' => 'han2zenCommaQuate',
                    ),        
    );
}

/**
 *  weborder_custinfo_upgradeinp�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderCustinfoUpgradeInp extends Dwo_ActionClass
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
     *  weborder_custinfo_upgradeinp�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
	   	if ($this->af->validate() > 0) {
//			return 'weborder_custinfo_upgradeinp';  // levan test for desize
			return 'weborder_order_upgradedetail';
		}
        return null;
    }

    /**
     *  weborder_custinfo_upgradeinp�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("custinfo");
		
        // ���j���[����CALL���ꂽ�ꍇ�̍l��
		$this->session->start();
		$cust_num = $this->session->get("cust_num");
		
		$upgradeorderinfosession = new UpgradeOrderInfoSession($this->session);
		$upgradeorderinfo = $upgradeorderinfosession->get();
			
		$custdao = new CustDAO();
		$custinfo = $custdao->find_by_id($cust_num); 
		
		//���X�̔z�B���
		$upgradeorderinfo->delivery_cust_code = $custinfo->custCode ;
		$upgradeorderinfo->delivery_seq 	  = "1"                 ;
		$upgradeorderinfo->delivery_name      = $custinfo->personName  ;
		$upgradeorderinfo->delivery_zip		  = $custinfo->zip      ;
		$upgradeorderinfo->delivery_pref      = $custinfo->pref     ;
		$upgradeorderinfo->delivery_pref_cd   = $custinfo->prefcd   ;
		$upgradeorderinfo->delivery_add1      = $custinfo->address1 ;
		$upgradeorderinfo->delivery_add2      = $custinfo->address2 ;
		$upgradeorderinfo->delivery_add3      = $custinfo->address2 ;
		$upgradeorderinfo->delivery_name_of_charge = $custinfo->name;
		
		//Phone Processing
		$phone_number = split("-", $custinfo->tel,3);
		$upgradeorderinfo->delivery_tel1 = $phone_number[0];
		$upgradeorderinfo->delivery_tel2 = $phone_number[1];
		$upgradeorderinfo->delivery_tel3 = $phone_number[2];
		
		//Fax processing
		$fax_number   = split("-", $custinfo->fax,3);
		$upgradeorderinfo->delivery_fax1 = $fax_number[0];
		$upgradeorderinfo->delivery_fax2 = $fax_number[1];
		$upgradeorderinfo->delivery_fax3 = $fax_number[2];
		//�o�^���`
		$upgradeorderinfo->regist_name  = $custinfo->name;
		$upgradeorderinfo->regist_kana  = $custinfo->nameKana;
		
		//��\��
		$upgradeorderinfo->regist_ceo        = $custinfo->ceoname;
		$upgradeorderinfo->regist_ceo_kana   = $custinfo->ceonameKana;
		
		//�o�^�d�b�ԍ��̏���
		$telephone = split("-", $custinfo->tel,3);
		$upgradeorderinfo->regist_tel1 = $telephone[0];
		$upgradeorderinfo->regist_tel2 = $telephone[1];
		$upgradeorderinfo->regist_tel3 = $telephone[2];
		
		//���l�E�S���� �E�M�Д���
    	$upgradeorderinfo->cust_order_num    = $this->af->get("frm_cust_order_num");
		$upgradeorderinfo->order_tantou_name = $this->af->get("frm_order_tantou_name");
		
		if ($this->af->get("frm_remarks")!= ""){
			$upgradeorderinfo->remarks = $this->af->get("frm_remarks");
		} else {
			$upgradeorderinfo->remarks = $upgradeorderinfo->regist_name;
		}
		
		$this->session->set("cust_order_num",$upgradeorderinfo->cust_order_num);
		$this->session->set("order_tantou_name",$upgradeorderinfo->order_tantou_name);
		$this->session->set("remarks",$upgradeorderinfo->remarks);
		
		$this->af->set("frm_regist_name" , $upgradeorderinfo->regist_name);
		$this->af->set("frm_regist_kana" , $upgradeorderinfo->regist_kana);
		$this->af->set("frm_regist_tel1"  , $upgradeorderinfo->regist_tel1);
		$this->af->set("frm_regist_tel2"  , $upgradeorderinfo->regist_tel2);
		$this->af->set("frm_regist_tel3"  , $upgradeorderinfo->regist_tel3);
		$this->af->set("frm_regist_ceo" , $upgradeorderinfo->regist_ceo);
		$this->af->set("frm_regist_ceo_kana" , $upgradeorderinfo->regist_ceo_kana);
		
		// ���A�h�K�{����̂��߂ɃI���R�����ǂ����̌ڋq�敪���Z�b�g���Ă���
		$this->af->set("chk_cust_kbn"                  , $upgradeorderinfo->cust_kbn);

		// ����ȍ~�\���p�Ƃ��ăZ�b�V�����ɃZ�b�g ����No����l�Ȃǂ��Z�b�g�����
		$upgradeorderinfosession->set($upgradeorderinfo);
		$this->session->set("upgradeorderinfo", $upgradeorderinfosession->toArray());

		$preDAO = new PrefDAO();
		$preList = $preDAO->find();
		for ($i = 0; $i < $preList->size(); $i++) {
			$kdata = $preList->get($i);
			$kenList[$i]['code'] = $kdata->code;
			$kenList[$i]['name'] = $kdata->name;
		}
		$this->session->set("kenList" ,$kenList);

		$this->af->setApp("forCpOrderinfo", $upgradeorderinfosession->toArray());

        return 'weborder_custinfo_upgradeinp';
    }
}
?>
