<?php
/**
 *  Weborder/Custinfo/UpgradeInpDo.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_custinfo_upgradeinp_do�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderCustinfoUpgradeInpDo extends Dwo_ActionForm
{
    /** @var    bool    �o���f�[�^�Ƀv���O�C�����g���t���O */
    var $use_validator_plugin = true;

    /**
     *  @access private
     *  @var    array   �t�H�[���l��`
     */
    var $form = array(
        /*
        'sample' => array(
            // �t�H�[���̒�`
            'type'          => VAR_TYPE_INT,    // ���͒l�^
            'form_type'     => FORM_TYPE_TEXT,  // �t�H�[���^
            'name'          => '�T���v��',      // �\����

            // �o���f�[�^(�L�q���Ƀo���f�[�^�����s����܂�)
            'required'      => true,            // �K�{�I�v�V����(true/false)
            'min'           => null,            // �ŏ��l
            'max'           => null,            // �ő�l
            'regexp'        => null,            // ������w��(���K�\��)

            // �t�B���^
            'filter'        => null,            // ���͒l�ϊ��t�B���^�I�v�V����
        ),
        */
/*
          'frm_regist_name' => array(
                    'name' =>'�o�^���`',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'required_error'=> '�o�^���`����͂��ĉ������B',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_kana' => array(
                    'name' =>'�o�^���`(�J�^�J�i)',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'required_error'=> '�o�^���`(�J�^�J�i)����͂��ĉ������B',
                    'filter' => 'han2zenCommaQuate',
                    ),
*/
          'frm_regist_zip1' => array(
                    'name' =>'�X�֔ԍ�1',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'type_error'    => '�X�֔ԍ�1�͐��l����͂��ĉ������B',
                    'required_error'=> '�X�֔ԍ�1����͂��ĉ������B',
                    ),
          'frm_regist_zip2' => array(
                    'name' =>'�X�֔ԍ�2',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'type_error'    => '�X�֔ԍ�2�͐��l����͂��ĉ������B',
                    'required_error'=> '�X�֔ԍ�2����͂��ĉ������B',
                    ),
          'frm_regist_pref_cd' => array(
                    'name' =>'�s���{��',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'required_error'=> '�s���{�����w�肵�ĉ������B',
                    ),
          'frm_regist_pref' => array(
                    'name' =>'�s���{����',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    ),
          'frm_regist_add1' => array(
                    'name' =>'�s���{���s�撬��',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'required_error'=> '�s���{���s�撬������͂��ĉ������B',
                    'max' => 32,
                    'max_error'=> '�s���{���s�撬���͑S�p16�����ȓ��œ��͂��Ă��������B',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_add2' => array(
                    'name' =>'���Ԓn',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'required_error'=> '���Ԓn����͂��ĉ������B',
                    'max' => 40,
                    'max_error'=> '���Ԓn�͑S�p20�����ȓ��œ��͂��Ă��������B',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_add3' => array(
                    'name' =>'������',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'max' => 40,
                    'max_error'=> '�������͑S�p20�����ȓ��œ��͂��Ă��������B',
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_ceo' => array(
                    'name' =>'��\�Ҏ�����܂��͑�\��',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_ceo_kana' => array(
                    'name' =>'��\�Ҏ�����܂��͑�\��(�J�^�J�i)',
                    'type' => VAR_TYPE_STRING,
                    'custom'    => 'checkKanji',
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_name_of_charge' => array(
                    'name' =>'�S���Җ�',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_name_of_charge_kana' => array(
                    'name' =>'�S���Җ�(�J�^�J�i)',
                    'type' => VAR_TYPE_STRING,
                    'custom'    => 'checkKanji',
                    'required'      => false,
                    'filter' => 'han2zenCommaQuate',
                    ),
          'frm_regist_tel1' => array(
                    'name' =>'�o�^�d�b�ԍ�1',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'required_error'=> '�o�^�d�b�ԍ�1����͂��ĉ������B',
                    'type_error'    => '�o�^�d�b�ԍ�1�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_tel2' => array(
                    'name' =>'�o�^�d�b�ԍ�2',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'required_error'=> '�o�^�d�b�ԍ�2����͂��ĉ������B',
                    'type_error'    => '�o�^�d�b�ԍ�2�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_tel3' => array(
                    'name' =>'�o�^�d�b�ԍ�3',
                    'type' => VAR_TYPE_INT,
                    'required'      => true,
                    'required_error'=> '�o�^�d�b�ԍ�3����͂��ĉ������B',
                    'type_error'    => '�o�^�d�b�ԍ�3�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_contact_tel1' => array(
                    'name' =>'�A����d�b�ԍ�1',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '�A����d�b�ԍ�1�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_contact_tel2' => array(
                    'name' =>'�A����d�b�ԍ�2',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '�A����d�b�ԍ�2�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_contact_tel3' => array(
                    'name' =>'�A����d�b�ԍ�3',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '�A����d�b�ԍ�3�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_contact_fax1' => array(
                    'name' =>'�A����FAX�ԍ�1',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '�A����FAX�ԍ�1�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_contact_fax2' => array(
                    'name' =>'�A����FAX�ԍ�2',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '�A����FAX�ԍ�2�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_contact_fax3' => array(
                    'name' =>'�A����FAX�ԍ�3',
                    'type' => VAR_TYPE_INT,
                    'required'      => false,
                    'type_error'    => '�A����FAX�ԍ�3�͐��l�œ��͂��ĉ������B',
                    ),
          'frm_regist_mail' => array(
                    'name' =>'���[���A�h���X',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'custom' => 'checkMailaddress',
                    'type_error'    => '���[���A�h���X�𐳂������͂��ĉ������B',
                    ),
          'frm_regist_mail_chk' => array(
                    'name' =>'���[���A�h���X�m�F',
                    'type' => VAR_TYPE_STRING,
                    'required'      => true,
                    'custom' => 'checkMailaddress',
                    'type_error'    => '���[���A�h���X�m�F�𐳂������͂��ĉ������B',
                    ),
          'frm_regist_url' => array(
                    'name' =>'�z�[���y�[�WURL',
                    'type' => VAR_TYPE_STRING,
                    'required'      => false,
                    ),
    );
   
     /**
	 * �����`�F�b�N
	 *
	 * @access public
	 * @param  string  $name   �t�H�[�����ږ�
	 */
	function checkKanji($name) {
		$valStr = $this->form_vars[$name];	
		if($valStr != ''){
			mb_regex_encoding('cp932');
			if (mb_ereg('[��-�]+',$valStr)) {
				$this->ae->add($name, "{form}�Ɋ����͎g�p�ł��܂���B", E_FORM_INVALIDVALUE);
			} else if (!mb_ereg('^[�@-���[]+$',$valStr)) {
				$this->ae->add($name, "{form}�ɂ͑S�p�J�^�J�i�݂̂���͂��ĉ������B", E_FORM_INVALIDVALUE);
			}
		}
	}
  
}

/**
 *  weborder_custinfo_upgradeinp_do�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderCustinfoUpgradeInpDo extends Dwo_ActionClass
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
     *  weborder_custinfo_upgradeinp_do�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("custinfo");
		$error_flag = FALSE;

		// �I���R���ETM�ȊO�̓��A�h�K�{�`�F�b�N
		$this->session->start();
		$orderinfosession = new UpgradeOrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();
		// ���A�h�K�{����̂��߂ɃI���R�����ǂ����̌ڋq�敪���Z�b�g���Ă���
		$this->af->set("chk_cust_kbn" , $orderinfo->cust_kbn);

		// ���L�o���f�[�V�����G���[�������ł��[�i��R�s�[���@�\����悤��
		$this->af->setApp("forCpOrderinfo", $orderinfosession->toArray());

		// �o���f�[�V�����`�F�b�N
	   	if ($this->af->validate() > 0) {
			if ($orderinfo->cust_kbn != "OR") {
				// ���[���A�h���X�J�X�^���`�F�b�N�ɑ΂���EUC�G���[���b�Z�[�W�o�͂���������
				if ($this->ae->getMessage('frm_regist_mail') != "") {
					$this->ae->clear();
					$res = Ethna::raiseNotice('���[���A�h���X�𐳂������͂��ĉ������B', E_DWO_SYSERROR );
					$this->ae->addObject(null, $res);
					$error_flag = TRUE;
				}
				
				if ($this->ae->getMessage('frm_regist_mail_chk') != "") {
					$this->ae->clear();
					$res = Ethna::raiseNotice('���[���A�h���X�m�F�𐳂������͂��ĉ������B', E_DWO_SYSERROR );
					$this->ae->addObject(null, $res);
					$error_flag = TRUE;
				}
			}
			$error_flag = TRUE;
		}

		// ���[���A�h���X�`�F�b�N
		if ($this->af->get('frm_regist_mail') != $this->af->get('frm_regist_mail_chk')) {
			$this->ae->clear();
			$res = Ethna::raiseNotice('���[���A�h���X�m�F�ɂ̓��[���A�h���X�Ɠ������̂���͂��Ă��������B', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			$error_flag = TRUE;
		}
		
		if($error_flag){
			$this->af->set("frm_regist_name",$orderinfo->regist_name);
			$this->af->set("frm_regist_kana",$orderinfo->regist_kana);
			return 'weborder_custinfo_upgradeinp';
		}
        return null;
    }

    /**
     *  weborder_custinfo_upgradeinp_do�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("orderconfirm");
		$this->session->start();
		$orderinfosession = new UpgradeOrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();

		$orderinfo->regist_zip1                = $this->af->get("frm_regist_zip1"               );
		$orderinfo->regist_zip2                = $this->af->get("frm_regist_zip2"               );
		$orderinfo->regist_pref_cd             = $this->af->get("frm_regist_pref_cd"            );
		$orderinfo->regist_pref                = $this->af->get("frm_regist_pref"               );
		$orderinfo->regist_add1                = $this->af->get("frm_regist_add1"               );
		$orderinfo->regist_add2                = $this->af->get("frm_regist_add2"               );
		$orderinfo->regist_add3                = $this->af->get("frm_regist_add3"               );
//		$orderinfo->regist_ceo                 = $this->af->get("frm_regist_ceo"                );
//		$orderinfo->regist_ceo_kana            = $this->af->get("frm_regist_ceo_kana"           );
		$orderinfo->regist_name_of_charge      = $this->af->get("frm_regist_name_of_charge"     );
		$orderinfo->regist_name_of_charge_kana = $this->af->get("frm_regist_name_of_charge_kana");
		$orderinfo->regist_tel1                = $this->af->get("frm_regist_tel1"               );
		$orderinfo->regist_tel2                = $this->af->get("frm_regist_tel2"               );
		$orderinfo->regist_tel3                = $this->af->get("frm_regist_tel3"               );
		$orderinfo->regist_contact_tel1        = $this->af->get("frm_regist_contact_tel1"       );
		$orderinfo->regist_contact_tel2        = $this->af->get("frm_regist_contact_tel2"       );
		$orderinfo->regist_contact_tel3        = $this->af->get("frm_regist_contact_tel3"       );
		$orderinfo->regist_contact_fax1        = $this->af->get("frm_regist_contact_fax1"       );
		$orderinfo->regist_contact_fax2        = $this->af->get("frm_regist_contact_fax2"       );
		$orderinfo->regist_contact_fax3        = $this->af->get("frm_regist_contact_fax3"       );
		$orderinfo->syonin_mail_flg            = 1 											 ; //�����L���������[���֑���
		$orderinfo->regist_mail                = $this->af->get("frm_regist_mail"               );
		$orderinfo->regist_mail_chk            = $this->af->get("frm_regist_mail_chk"           );
		$orderinfo->regist_url                 = $this->af->get("frm_regist_url"                );

		// �S�p�ϊ�
		$mbconvutil = new MbConvUtil();
//		$orderinfo->regist_name                = $mbconvutil->convert($orderinfo->regist_name               );
//		$orderinfo->regist_kana                = $mbconvutil->convert($orderinfo->regist_kana               );
		$orderinfo->regist_add1                = $mbconvutil->convert($orderinfo->regist_add1               );
		$orderinfo->regist_add2                = $mbconvutil->convert($orderinfo->regist_add2               );
		$orderinfo->regist_add3                = $mbconvutil->convert($orderinfo->regist_add3               );
//		$orderinfo->regist_ceo                 = $mbconvutil->convert($orderinfo->regist_ceo                );
//		$orderinfo->regist_ceo_kana            = $mbconvutil->convert($orderinfo->regist_ceo_kana           );
		$orderinfo->regist_name_of_charge      = $mbconvutil->convert($orderinfo->regist_name_of_charge     );
		$orderinfo->regist_name_of_charge_kana = $mbconvutil->convert($orderinfo->regist_name_of_charge_kana);

		$orderinfosession->set($orderinfo);
		
		// �󒍏��Z�b�g
		$this->af->setApp("orderinfo", $orderinfosession->toArray());
				
		//�J�[�g�֏��i������
		
		$DwoBasket = array();
		// Levan basic_item_cd -> second_total_sp_item_cd
		// $DwoBasket[0]['product_code'       ] = $this->session->get("basic_item_cd");
		$DwoBasket[0]['product_code'       ] = $this->session->get("second_total_sp_item_cd");
		$DwoBasket[0]['item_name_kanji'    ] = $this->session->get("soft_name");
		$DwoBasket[0]['base_name'          ];
		$DwoBasket[0]['count'              ]= 1 ;
		$DwoBasket[0]['status'             ];
		$DwoBasket[0]['sales_price'        ] = $this->session->get("upgrade_sale_price");
		$DwoBasket[0]['price_invoice_price'] = $this->session->get("upgrade_price");
		$DwoBasket[0]['cust_order_num'     ] = $this->session->get("cust_order_num");
		$DwoBasket[0]['item_class_large'   ] = $this->session->get("upgrade_item_large");
		$DwoBasket[0]['item_class_medium']   = $this->session->get("upgrade_item_medium");
		$DwoBasket[0]['item_ship_date'];
		$DwoBasket[0]['support_code'       ];
		$DwoBasket[0]['support_price'      ];
		$DwoBasket[0]['sup_item_name'      ];
		$DwoBasket[0]['support_base_price' ];
		
		$this->session->set("DwoBasket",$DwoBasket);
		$basketsession = new BasketSession($this->session);

		// ���L�e���v���͂��q�l�o�^���Ȃ��ꍇ�͕ʂ̃A�N�V����(Order/Confirm)����CALL����邱�Ƃɒ���
        return 'weborder_order_upgradeconfirm';
    }

}
?>
