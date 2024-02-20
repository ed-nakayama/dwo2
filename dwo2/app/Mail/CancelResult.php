<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


 /*************************************************************
 * 利用ファイル
 *   classes/AcceptanceManager.php        cancelResultMail()
 *   classes/UpgradeAcceptanceManager.php cancelResultMail()
 ***************************************************************/
class CancelResult extends Mailable
{
    use Queueable, SerializesModels;

    // 下記を追記
    /**
     * メール送信引数
     *
     * @var array
     */
    private $orderNoList;
    
    // 上記までを追記

    // 下記内容を修正
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderNoList)
    {
        $this->orderNoList = $orderNoList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $to = config('dwo.DWO_ORDER_CENTER_MAIL');
        $from = config('dwo.DWO_SYS_MAIL_FROM');
        
    	return $this->to($to)
					->from($from)
					->subject("【承認期限切れ注文自動取り消し処理結果")
					->text('mail_templates.cancelResult') // 本文
					->with([
						'orderNoList' => $this->orderNoList,
					]);       // 本文に送る値
    }

}