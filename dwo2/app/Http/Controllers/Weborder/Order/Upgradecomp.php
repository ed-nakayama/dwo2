<?php
/**
 *  Weborder/Order/Upgradecomp.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_order_upgradecomp�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderOrderUpgradeComp extends Dwo_ActionForm
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

          'frm_regist' => array(
                    'name' =>'�I�[�_�[�m��',
                    'type' => VAR_TYPE_STRING,
					'required'      => false,
                    ),

    );
}

/**
 *  weborder_order_upgradecomp�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */

class Dwo_Action_WeborderOrderUpgradeComp extends Dwo_ActionClass
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
     *  weborder_order_upgradecomp�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_order_upgradecomp�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// ���j���[�ݒ�
		$menumanager = new UpgradeMenuManager($this);
		$menumanager->setMenuComplete("complete");

		if ($this->af->get("frm_regist") == "EXEC") {
			// �o�^�A���[�����M����
			$orderregistmanager = new UpgradeOrderRegistManager($this);
			$basketsession = new BasketSession($this->session);
            $result = $orderregistmanager->RegistOrder();

			if (Ethna::isError($result)) {

/* 2008/05/19 ���[�����M�G���[�̓��[���o�b�N���Ȃ��Bby nakayama
				$chk_orderSeqNum = $this->session->get("ORDER_SEQ_NO");
				if ($chk_orderSeqNum != "") { // ��̏ꍇ�͓o�^�����O�Ȃ̂Ń��[���o�b�N�̕K�v�Ȃ�
					// DB���[���o�b�N
					$orderregistmanager->RegistRollback($chk_orderSeqNum);
				}
*/
				$this->ae->addObject(null, $result);
				return 'weborder_error';
			}

			// (�Q�d�o�^�h�~�p)
			// �o�X�P�b�g���̃N���A
			$basketsession = new BasketSession($this->session);
			$basketsession->clear();
			
			// �I�[�_�[���̃N���A
			$upgradeorderinfosession = new UpgradeOrderInfoSession($this->session);
			$upgradeorderinfosession->resetComplete(); // �K�v�ȏ��͎c��
			
			$this->session->set("cust_order_num","");
			$this->session->set("order_tantou_name","");
			$this->session->set("remarks","");
		}

        return 'weborder_order_upgradecomp';
    }
}
?>
