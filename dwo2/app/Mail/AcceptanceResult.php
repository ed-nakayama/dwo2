<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   weborder/Recognize/RecognizeTop.php  do()
 ***************************************************************/
class AcceptanceResult extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $acceptance_action;
    private $title;
    private $mailTo;
    private $agentView;
    private $weborderdetailList;
    private $weborderheader;
    private $acceptance;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($acceptance_action, $title, $mailTo, $agentView, $weborderdetailList, $weborderheader, $acceptance)
    {
        $this->acceptance_action  = $acceptance_action;
        $this->title              = $title;
        $this->mailTo             = $mailTo;
        $this->agentView          = $agentView;
        $this->weborderdetailList = $weborderdetailList;
        $this->weborderheader     = $weborderheader;
        $this->acceptance         = $acceptance;
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
			->subject($this->title)
			->text('mail_templates.acceptanceresult') // 本文
			->with([
				'acceptance_action'  => $this->acceptance_action,
				'agentView'          => $this->agentView,
				'weborderdetailList' => $this->weborderdetailList,
				'weborderheader'     => $this->weborderheader,
				'acceptance'         => $this->acceptance,
			]);       // 本文に送る値

    }

}