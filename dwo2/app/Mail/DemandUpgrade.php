<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   classes/UpgradeAcceptanceManager.php demandMail()
 ***************************************************************/
class DemandUpgrade extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $mailTo;
    private $agentview;
    private $acceptance;
    private $weborderheader;
    private $weborderdetailList;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailTo, $agentview, $acceptance, $weborderheader, $weborderdetailList)
    {
        $this->mailTo = $mailTo;
        $this->agentview = $agentview;
        $this->acceptance = $acceptance;
        $this->weborderheader = $weborderheader;
        $this->weborderdetailList = $weborderdetailList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$from = config('dwo.DWO_SYS_MAIL_FROM');
		$cc = config('dwo.DWO_SYS_MAIL_BCC');

		return $this->to($this->mailTo)
	    			->bcc($cc)
	    			->from($from)
	    			->subject("【弥生Webオーダー】承認期限が迫っております[受付No.{$this->acceptance->order_acceptance_header_no}]")
        			->text('mail_templates.demandUpgrade') // 本文
	     			->with([
	        			'agentview'          => $this->agentview,
	        			'acceptance'         => $this->acceptance,
	        			'weborderheader'     => $this->weborderheader,
	        			'weborderdetailList' => $this->weborderdetailList,
	        		]);       // 本文に送る値
	     
    }

}