<?php
require_once ("config.inc");

class MailTranStatusAlert {

	private $callAction;   // �Ăяo���A�N�V����
	private $ses;          // �Ăяo���A�N�V����
	private $agentInfo;    // AgentView�N���X�z��(�Z�b�V��������)

	/*
	 * �R���X�g���N�^
	 * ����: �Ăяo���N���X
	 */
	function __construct($callobj) {
		$this->callAction = $callobj->af;
		$this->ses        = $callobj->session;
		$this->agentInfo  = $this->ses->get("agentAry"); // Array

	}

	function StatusAlert() {
		// ���[����p�f�[�^�̍쐬
		$reportAry['mailFrom']  = DWO_SYS_MAIL_FROM; // ���M��(config.inc���)
		$reportAry['mailBcc']  = DWO_SYS_MAIL_BCC; // ���M��(config.inc���)
		$reportAry['agentMail']  = $this->agentInfo['mail'];

		$reportAry['agentInfo']  = $this->agentInfo;

		// �f�[�^�z���EUC��(Ethna���[���p)
		$mailutil = new MailUtil();
		$reportAry = $mailutil->ArrayValConvertEuc($reportAry);

		mb_language ("Japanese");
		mb_internal_encoding("EUC_JP");
		$ethna_mail =& new Ethna_MailSender($this->callAction->backend);

		// from,to���l
		return $ethna_mail->send(DWO_SYS_MAIL_FROM,'alerttranstatus.tpl', $reportAry);
	}
}
?>
