<?php
/**
 *  Weborder/Order/Upgrade.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_order_upgrade�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderOrderUpgradeconfirm extends Dwo_ActionForm
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
 *  weborder_order_upgrade�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderOrderUpgradeconfirm extends Dwo_ActionClass
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
     *  weborder_order_upgrade�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_order_upgrade�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenu("orderconfirm");
		$credit_flag = TRUE;

		$this->session->start();
		$upgradeorderinfosession = new UpgradeOrderInfoSession($this->session);
		$upgradeorderinfo = $upgradeorderinfosession->get();
		// �󒍏��Z�b�g
		$this->af->setApp("orderinfo", $upgradeorderinfosession->toArray());
		
		// ���L�e���v���͂��q�l�o�^������ꍇ��Custinfo/InputDo����CALL����邱�Ƃɒ��ӁB
        return 'weborder_order_upgradeconfirm';
    }
}
?>
