<?php
/**
 *  Weborder/Testtest.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_testtest�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderTesttest extends Dwo_ActionForm
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
 *  weborder_testtest�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderTesttest extends Dwo_ActionClass
{
    /**
     *  weborder_testtest�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_testtest�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
/*
		// �o�ד��̎擾�Ăяo�� ---- ��������
		//$shippingdatedao = new ShippingDateDAO();
		$shippingdatedao = new CalendarMtDAO();
		$ship = $shippingdatedao->getShippingDate();
		// �o�ד��̎擾�Ăяo�� ---- �����܂�

		//$this->af->setApp("testship", $ship);
		$this->af->setApp("testship", "https://".SERVER_NAME.URL_DOC_ROOT."?xxx=aaa");
*/

		$dbgconvdao = new dbgConvDAO();
		$dbgconvdao->update();

        return 'weborder_testtest';
    }
}
?>
