<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   classes/UpgradeOrderRegistManager   orderReportMail() - 未使用
 ***************************************************************/
class UpgradeOrderReport extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $orderSeq;
    private $orderInfo;
    private $agentView;
    private $basketList;
    private $ago2week;
    private $weborderheader;
    private $mailTo;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderSeq, $orderInfo,  $agentView, $basketList, $weborderheader, $ago2week, $mailTo)
    {
        $this->orderSeq       = $orderSeq;
        $this->orderInfo      = $orderInfo;
        $this->agentInfo      = $agentView;
        $this->basketList     = $basketList;
        $this->weborderheader = $weborderheader;
        $this->ago2week       = $ago2week;
        $this->mailTo         = $mailTo;
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

		if ($this->orderInfo->syonin_mail_flg == 1) { // 承認メール送信報告用
    		return $this->to($this->mailTo)
	    			->bcc($cc)
					->from($from)
					->subject("【弥生Webオーダー】承認確認メール配信のお知らせ[受付No.{$this->weborderheader->web_order_num}]")
					->text('mail_templates.orderreport') // 本文
					->with([
						'orderSeq'       => $this->orderSeq,
						'orderInfo'      => $this->orderInfo,
						'agentView'      => $this->agentView,
						'basketList'     => $this->basketList,
						'weborderheader' => $this->weborderheader,
						'ago2week'       => $this->ago2week,
					]);       // 本文に送る値

		} else { // YBPなど承認なし用
    		return $this->to($this->mailTo)
	    			->bcc($cc)
					->from($from)
					->subject("【【弥生Webオーダー】ご注文受付完了のお知らせ[受付No.{$this->weborderheader->web_order_num}]")
					->text('mail_templates.orderreport') // 本文
					->with([
						'orderSeq'       => $this->orderSeq,
						'orderInfo'      => $this->orderInfo,
						'agentView'      => $this->agentView,
						'basketList'     => $this->basketList,
						'weborderheader' => $this->weborderheader,
						'ago2week'       => $this->ago2week,
					]);       // 本文に送る値

		}
    }

}