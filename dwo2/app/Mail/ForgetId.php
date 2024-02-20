<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   weborder/Forgetchk   chk_profile()
 ***************************************************************/
class ForgetId extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $custid ,$cust_name ,$cust_mail;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($custid ,$cust_name ,$cust_mail)
    {
        $this->custid = $custid;
        $this->cust_name = $cust_name;
        $this->cust_mail = $cust_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this->to($this->cust_mail)
			->bcc(config('dwo.DWO_SYS_MAIL_BCC'))
	    	->from(config('dwo.DWO_SYS_MAIL_FROM'))
	    	->subject("弥生WebOrder：ID通知")
        	->text('mail_templates.forgetid') // 本文
	    	->with([
	    		'custid' => $this->custid,
	       		'cust_name' => $this->cust_name,
	       	]);       // 本文に送る値
	     
    }

}