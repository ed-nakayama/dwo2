<?php
/**
 *  Weborder/Top/Home.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_top_home�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderTopHomeupgrade extends Dwo_ActionForm
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
        
        'basic_item_cd' => array(
        	'type'          => VAR_TYPE_STRING,    // ���͒l�^
            'name'          => '�w�����i�x�[�V�b�NCD',      // �\����
            'required'      => true,            // �K�{�I�v�V����(true/false)
			'required_error'=> '',
			'type_error'    => '',
        ),
    );
    
    
}

/**
 *  weborder_top_home�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderTopHomeupgrade extends Dwo_ActionClass
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
     *  weborder_top_home�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_top_home�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {

		$month_num = $this->session->get("month_num");

		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("home");
		$basic_item_cd = $this->af->get("basic_item_cd");
		$this->af->set("basic_item_cd",$basic_item_cd);
		// �^�M�f�[�^�擾(�ăZ�b�g)
		$creditinfomanager = new CreditInfoManager();
		$creditinfo = $creditinfomanager->GetCreditData($this->session);
		$this->session->set("keep_creditinfo", $creditinfo->toArray());
		$basic_item_cd = $this->session->get("basic_item_cd");
		$soft_name = $this->session->get("soft_name");
		// echo "basic_item_cd: $basic_item_cd $soft_name";
        return 'weborder_top_homeupgrade';
    }
}
?>