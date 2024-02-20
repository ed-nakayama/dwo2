<?php
require_once ("config.inc");

class MailTranStatusAlert {

	private $callAction;   // 呼び出しアクション
	private $ses;          // 呼び出しアクション
	private $agentInfo;    // AgentViewクラス配列(セッションから)

	/*
	 * コンストラクタ
	 * 引数: 呼び出しクラス
	 */
	function __construct($callobj) {
		$this->callAction = $callobj->af;
		$this->ses        = $callobj->session;
		$this->agentInfo  = $this->ses->get("agentAry"); // Array

	}

	function StatusAlert() {
		// メール専用データの作成
		$reportAry['mailFrom']  = DWO_SYS_MAIL_FROM; // 送信元(config.incより)
		$reportAry['mailBcc']  = DWO_SYS_MAIL_BCC; // 送信元(config.incより)
		$reportAry['agentMail']  = $this->agentInfo['mail'];

		$reportAry['agentInfo']  = $this->agentInfo;

		// データ配列のEUC化(Ethnaメール用)
		$mailutil = new MailUtil();
		$reportAry = $mailutil->ArrayValConvertEuc($reportAry);

		mb_language ("Japanese");
		mb_internal_encoding("EUC_JP");
		$ethna_mail =& new Ethna_MailSender($this->callAction->backend);

		// from,to同様
		return $ethna_mail->send(DWO_SYS_MAIL_FROM,'alerttranstatus.tpl', $reportAry);
	}
}
?>
