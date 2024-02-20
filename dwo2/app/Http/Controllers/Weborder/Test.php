<?php
/**
 *  Weborder/Test.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_Test�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderTest extends Dwo_ActionForm
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
 *  weborder_Test�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderTest extends Dwo_ActionClass
{
    /**
     *  weborder_Test�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
        return null;
    }

    /**
     *  weborder_Test�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		$calendarmtdao = new CalendarMtDAO();
		$arr_date['year'] = date("Y");
		$arr_date['mon'] = date("m");
		$cal = $calendarmtdao->getCalendarDate($arr_date);

		$day = 0;
		$cancelDay = 0;
		$last_idx = strlen($cal) - 1;
print("last_idx=" . $last_idx . "<br>");
		for ($i = $last_idx; $i >= 0; $i--) {
print("cal[]=" . $cal[$i] . "<br>");
			if($cal[$i] == 1) {
				$cancelDay = $i;
				$day++;
			}

			if ($day == 2) break; // �����ŏI�c�Ɠ�����R�c�Ɠ��O
		}
print("cancelDay=" . $cancelDay . "<br>");

        return 'weborder_top_condition';
    }
}
?>
