<?php

namespace App\Http\Controllers\Classes;

class MailCreditLimit {

	private $callAction;   // 呼び出しアクション
	private $ses;          // 呼び出しアクション
	private $agentView;    // AgentViewクラス配列(セッションから)

	/*
	 * コンストラクタ
	 * 引数: 呼び出しクラス
	 */
	function __construct($callobj) {
		$this->callAction = $callobj->af;
		$this->ses        = $callobj->session;
		$this->agentView  = $this->ses->get("agentView"); // Array

	}

	function MailCreLimit($errPage) {
		// メール専用データの作成
		$reportAry['mailFrom']  = config('dwo.DWO_SYS_MAIL_FROM'); // 送信元(config.incより)
		$reportAry['mailBcc']  = config('dwo.DWO_SYS_MAIL_BCC'); // 送信元(config.incより)
		$reportAry['err_page']  = $errPage;
		$reportAry['agentMail']  = $this->agentView->mail_address;

		$reportAry['agentInfo']  = $this->agentView;

		// データ配列のEUC化(Ethnaメール用)
//		$mailutil = new MailUtil();
//		$reportAry = $mailutil->ArrayValConvertEuc($reportAry);

//		mb_language ("Japanese");
		mb_internal_encoding("EUC_JP");
		$ethna_mail =& new Ethna_MailSender($this->callAction->backend);

		// from,to同様
		return $ethna_mail->send(DWO_SYS_MAIL_FROM,'alertcreditlimit.tpl', $reportAry);
	}
}
