<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   classes/OrderRegistManager          orderReportMail()
 *   classes/UpgradeOrderRegistManager   orderReportMail() - 未使用
 ***************************************************************/
class ReserveOrderReport extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $orderinfo;
    private $agentView;
    private $basketlist;
    private $ago2week;
    private $weborderheader;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderinfo,  $agentView, $basketlist, $weborderheader, $ago2week)
    {
        $this->orderinfo      = $orderinfo;
        $this->agentView      = $agentView;
        $this->basketlist     = $basketlist;
        $this->weborderheader = $weborderheader;
        $this->ago2week       = $ago2week;
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

		if ($orderinfo->syonin_mail_flg == 1 && $this->orderinfo->cust_kbn != "OR") {
    		return $this->to($this->weborderheader->license_mail_address)
	    			->bcc($cc)
					->from($from)
					->subject("弥生Webオーダー(予約)】承認確認メール配信のお知らせ[受付No.{$this->weborderheader->web_order_num}]")
					->text('mail_templates.reserve_orderreport2') // 本文
					->with([
						'orderinfo'      => $this->orderinfo,
						'agentView'      => $this->agentView,
						'basketlist'     => $this->basketlist,
						'weborderheader' => $this->weborderheader,
						'ago2week'       => $this->ago2week,
					]);       // 本文に送る値

		} else {
    		return $this->to($this->weborderheader->license_mail_address)
	    			->bcc($cc)
					->from($from)
					->subject("【弥生Webオーダー】予約ご注文受付完了のお知らせ[受付No.{$this->weborderheader->web_order_num}]")
					->text('mail_templates.reserve_orderreport1') // 本文
					->with([
						'orderinfo'      => $this->orderinfo,
						'agentView'      => $this->agentView,
						'basketlist'     => $this->basketlist,
						'weborderheader' => $this->weborderheader,
						'ago2week'       => $this->ago2week,
					]);       // 本文に送る値

		}
    }

}