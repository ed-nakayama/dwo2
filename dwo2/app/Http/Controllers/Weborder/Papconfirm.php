<?php
/**
 *  Weborder/Papconfirm.php
 *
 *  @author     {$author}
 *  @package    Dwo
 *  @version    $Id: skel.action.php,v 1.10 2006/11/06 14:31:24 cocoitiban Exp $
 */

/**
 *  weborder_papconfirm�t�H�[���̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Form_WeborderPapconfirm extends Dwo_ActionForm
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
			'required_error'=> 'PAP����ԍ��𐔎��Ő��������͂��Ă�������',
			'type_error'    => 'PAP����ԍ��𐔎��Ő��������͂��Ă�������',
        ),
    );
}

/**
 *  weborder_papconfirm�A�N�V�����̎���
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Dwo
 */
class Dwo_Action_WeborderPapconfirm extends Dwo_ActionClass
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
     *  weborder_papconfirm�A�N�V�����̑O����
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
     *  weborder_papconfirm�A�N�V�����̎���
     *
     *  @access public
     *  @return string  �J�ږ�
     */
    function perform()
    {
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

		// �T�|�[�g�J�n���A�I�����̃`�F�b�N
		$supportdao = new SupportDAO();
		$support = $supportdao->findLast($agentview->accountNum, $agentview->supportSeqNum);
		// �f�[�^�擾�`�F�b�N
		if (($support->account_num == "") || ($support->end_date=="")) {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̉����񂪐������o�^����Ă��܂���B(�T�|�[�g�o�^)', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}
		// ���t����
		$now = date("Ymd");
		if ($now > $support->end_date) {
			$res = Ethna::raiseNotice('�w�肵���ԍ�['.$pap_acc_num.']�̓T�|�[�g���ԊO�̂��ߎg�p�ł��܂���B', E_DWO_SYSERROR );
			$this->ae->addObject(null, $res);
			return 'weborder_papinput';
		}

		// �퐶�P�R�Ή� 2012/11/11
		$memberTypeName = '';
		$memberType = $agentview->getCustClassCode();
		if ($memberType == 'GOLD') {
			$memberTypeName = '�S�[���h���';
		} else if ($memberType == 'PAP') {
			$memberTypeName = '�����o�[���';
		}

		$this->session->set('memberType', $memberType);

		$this->af->setApp("memberTypeName" ,$memberTypeName);
		$this->af->setApp("OriconPap", $agentview->toArray());

        return 'weborder_papconfirm';
    }
}
?>