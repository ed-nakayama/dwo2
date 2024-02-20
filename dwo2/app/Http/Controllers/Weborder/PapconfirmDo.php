<?php
/**
 *  Weborder/PapconfirmDo.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_papconfirm_do�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderPapconfirmDo extends Dwo_ActionForm
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

        'pap_acc_num' => array(
            // �t�H�[���̒�`
            'type'          => VAR_TYPE_INT,    // ���͒l�^
            'name'          => 'PAP����ԍ�',      // �\����
            'required'      => true,            // �K�{�I�v�V����(true/false)
			'required_error'=> '�w�肵���ԍ��̉���͌�����Ȃ����A���ݖ����ł��B',
			'type_error'    => '�w�肵���ԍ��̉���͌�����Ȃ����A���ݖ����ł��B',
        ),
    );
}

/**
 *  weborder_papconfirm_do�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderPapconfirmDo extends Dwo_ActionClass
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
     *  weborder_papconfirm_do�A�N�V�����̑O����
     *
     *  @access public
     *  @return string      �J�ږ�(����I���Ȃ�null, �����I���Ȃ�false)
     */
    function prepare()
    {
		if ($this->af->validate() > 0) {
			return 'weborder_papinput';
		}
        return null;
    }

    /**
     *  weborder_papconfirm_do�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
		// ���j���[�ݒ�
		$menumanager = new MenuManager($this);
		$menumanager->setMenu("home");

		$pap_acc_num = $this->af->get("pap_acc_num");
		$mlicensedao = new MLicenseDAO();
		$mlicense = $mlicensedao->find($pap_acc_num);
		if ($mlicense->custNum == "") {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̉���͌�����Ȃ����A���ݖ����ł��B', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}

		// �ڋq��񌟍�
		$agentviewDAO = new AgentViewDAO();
		$agentviewDAO->pap_only = TRUE; // PAP�̂�
		$agentview = $agentviewDAO->findById($mlicense->custNum);
		if ($agentview->custCode == "") {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̉���͌�����Ȃ����A���ݖ����ł��B', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}

		$this->session->set("keep_OriconPapAgent", $agentview->toArray());

        return 'weborder_top_home';
    }
}
?>
