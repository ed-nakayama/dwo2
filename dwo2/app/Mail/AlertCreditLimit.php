<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   classes/MailCreditLimit   MailCreLimit() - 未使用
 ***************************************************************/
class AlertCreditLimit extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $agentView;
     private $errPage;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agentView , $errPage)
    {
        $this->agentView = $agentView;
        $this->errPage = $errPage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$mailTo = array();

		$from = config('dwo.DWO_SYS_MAIL_FROM');
		$cc = config('dwo.DWO_SYS_MAIL_BCC');

		$to  = $this->agentView->mail_address;

	    return $this->to($to)
	    			->bcc($cc)
	    			->from($from)
	    			->subject('弥生WebOrder与信超過情報（' . $this->err_page . '）')
        			->text('mail_templates.alertCreditLimit') // 本文
	       			->with([
	        			'agentView' => $this->agentView,
	        		]);       // 本文に送る値
    }

}