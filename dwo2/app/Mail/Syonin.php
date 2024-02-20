<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   weborder/top/TopHistory mail_do()
 *   classes/OrderRegistManager.php     syoninMail()
 *   classes/OUpgradeOrderRegistManager syoninMail()  - 未使用
 ***************************************************************/
class Syonin extends Mailable
{
    use Queueable, SerializesModels;

 /*************************************************************
 * メール送信引数
 *
 * @var array
 ***************************************************************/
    private $agentview;
    private $weborderheader;
    private $weborderdetailList;
    private $orderacceptance;
    private $ago2week;
    private $upgrade_flag;
    private $mailTo;
   
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($agentview, $weborderheader, $weborderdetailList, $orderacceptance, $ago2week, $upgrade_flag, $mailTo)
    {
        $this->agentview          = $agentview;
        $this->weborderheader     = $weborderheader;
        $this->weborderdetailList = $weborderdetailList;
        $this->orderacceptance    = $orderacceptance;
        $this->ago2week           = $ago2week;
        $this->upgrade_flag       = $upgrade_flag;
        $this->mailTo             = $mailTo;
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
					->subject("【弥生株式会社】ご登録内容確認のお願い[受付No.{$this->weborderheader->web_order_num}]")
					->text('mail_templates.syonin') // 本文
					->with([
						'agentview'          => $this->agentview,
						'weborderheader'     => $this->weborderheader,
						'weborderdetailList' => $this->weborderdetailList,
						'orderacceptance'    => $this->orderacceptance,
						'ago2week'           => $this->ago2week,
						'upgrade_flag'       => $this->upgrade_flag,
					]);       // 本文に送る値
    }

}