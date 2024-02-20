<?php
/**
 *  Weborder/SelorderDo.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_selorder_do�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderSelorderDo extends Dwo_ActionForm
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
          'mode' => array(
                    'name' =>'�w�����@',
                    'type' => VAR_TYPE_STRING,
					'required'      => true,
					'required_error' => '�w�����@��I�����Ă�������',
                    ),
    );
}

/**
 *  weborder_selorder_do�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderSelorderDo extends Dwo_ActionClass
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
     *  weborder_selorder_do�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
	   	if ($this->af->validate() > 0) {
			return 'weborder_error';
   		}
        return null;
    }

    /**
     *  weborder_selorder_do�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// �Z�b�V�����J�n
    	$this->session->start();

		// �o�X�P�b�g�͂����ł��N���A�[(�u���E�U�̖߂�Ή�)
		$basketsession = new BasketSession($this->session);
		$basketsession->clear();

		$orderinfosession = new OrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();

		if ($this->af->get("mode") == "pap") {
			$orderinfo->pap_order = TRUE;
		} else {
			$orderinfo->pap_order = FALSE;
		}
		if ($this->af->get("mode") == "upgrade") {
			$orderinfo->upgrade_order = TRUE;
		} else {
			$orderinfo->upgrade_order = FALSE;
		}
		// �Z�b�V�����ɏ����Z�b�g�����̃y�[�W��
		$orderinfosession->set($orderinfo);
		$this->session->set("orderinfo", $orderinfosession->toArray());

		if ($orderinfo->cust_kbn == "OR")  {
			// �I���R���̏ꍇ�Ń��[�h��PAP�I�[�_�[�̏ꍇ
			if ($orderinfo->pap_order == TRUE){ 
				return 'weborder_papinput';
			} 
			if ($orderinfo->upgrade_order == TRUE) {
				return 'weborder_upgrade';
			}  
			if (($orderinfo->pap_order == FALSE) || ($orderinfo->upgrade_order == FALSE)) { 
				// ���j���[�ݒ�
				$menumanager = new MenuManager($this);
				$menumanager->setMenu("home");
				return 'weborder_top_home';
			}
		} else {
			if ($orderinfo->upgrade_order == TRUE) {
				return 'weborder_upgrade';
			} else {
				// ���j���[�ݒ�
				$menumanager = new MenuManager($this);
				$menumanager->setMenu("home");
		        return 'weborder_top_home';
			}
		}
    }
}
?>