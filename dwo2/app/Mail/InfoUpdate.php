<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class InfoUpdate extends Mailable
{
    use Queueable, SerializesModels;

 /*************************************************************
 * メール送信引数
 *
 * @var array
 *
 * 利用ファイル
 *   weborder/top/TopHistory mail_do()
 *   weborder/recognize/RecognizeUpdate updateDo()
 *   classes/OrderRegistManager.php syoninMail()
 ***************************************************************/
    private $title;
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
    public function __construct($title, $mailTo, $agentview, $acceptance, $weborderheader, $weborderdetailList)
    {
        $this->title = $title;
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
					->subject($this->title)
					->text('mail_templates.infoUpdate') // 本文
					->with([
	        			'agentview'          => $this->agentview,
	        			'acceptance'         => $this->acceptance,
	        			'weborderheader'     => $this->weborderheader,
	        			'weborderdetailList' => $this->weborderdetailList,
					]);       // 本文に送る値
    }

}