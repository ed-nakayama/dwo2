<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   classes/MailTranStatusAlert StatusAlert() - 未使用
 ***************************************************************/
class AlertTranStatus extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $agentView;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agentView)
    {
        $this->agentView = $agentView;
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
	    			->subject("弥生WebOrder取引区分不正情報")
        			->text('mail_templates.alertTranStatus') // 本文
	       			->with([
	        			'agentView' => $this->agentView,
	        		]);       // 本文に送る値
    }

}