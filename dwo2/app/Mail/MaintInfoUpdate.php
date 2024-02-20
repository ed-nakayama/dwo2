<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

 /*************************************************************
 * 利用ファイル
 *   admin/order/OrderList2.php store()
 ***************************************************************/
class MaintInfoUpdate extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $profile;
    private $agentview;
    private $weborderheader;
    private $weborderdetailList;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($profile, $agentview, $weborderheader, $weborderdetailList)
    {
        $this->profile = $profile;
        $this->agentview = $agentview;
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
		$mailTo = array();

		if (!empty($this->profile->profile_mail_flag) && !empty($this->agentview->mail_address) ) {
			$mailTo[] = $this->agentview->mail_address;
		}

		if (!empty($this->profile->profile_extra_mail_flag) && !empty($this->profile->profile_extra_mail) ) {
			$mailTo[] = $this->profile->profile_extra_mail;
		}

		if (!empty($mailTo) ) {
	    	return $this->to($mailTo)
	    				->bcc(config('dwo.DWO_SYS_MAIL_BCC'))
	    				->from(config('dwo.DWO_SYS_MAIL_FROM'))
	    				->subject("【弥生Webオーダー】ご注文内容変更完了のお知らせ[受付No.{$this->weborderheader->web_order_num}]")
        				->text('mail_templates.maintInfoUpdate') // 本文
	       	 			->with([
	        				'agentview' => $this->agentview,
	        				'weborderheader' => $this->weborderheader,
	        				'weborderdetailList' => $this->weborderdetailList,
	        			]);       // 本文に送る値
	     
		} else {
			return;
		}
    }

}