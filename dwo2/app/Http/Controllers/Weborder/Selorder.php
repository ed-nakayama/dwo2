<?php
/**
 *  Weborder/Selorder.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_selorder�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderSelorder extends Dwo_ActionForm
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
    );
}

/**
 *  weborder_selorder�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderSelorder extends Dwo_ActionClass
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
     *  weborder_selorder�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_selorder�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {

/*
		$orderinfosession = new OrderInfoSession($this->session);
		$orderinfo = $orderinfosession->get();
        
  		if ($orderinfo->cust_kbn != "OR" && $orderinfo->cust_kbn != "YBP") {
			$errors[] = '�w�肳�ꂽ�y�[�W�͑��݂��܂���B';
			$this->af->setApp('errors', $errors);
			return 'weborder_notfound-forbidden';
		}
		������fillter�Ɉړ����܂���
*/
    	return 'weborder_selorder';
    }
}
?>
