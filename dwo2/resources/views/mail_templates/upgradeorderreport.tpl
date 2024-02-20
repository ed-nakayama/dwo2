From: {$mailFrom}
{if $mailCase == 'REG_REPORT' }
Subject: 【弥生Webオーダー】承認確認メール配信のお知らせ[受付No.{$orderSeq}]
{else}
Subject: 【弥生Webオーダー】ご注文受付完了のお知らせ[受付No.{$orderSeq}]
{/if}
{if $mailBcc!=""}
Bcc: {$mailBcc}
{/if}
X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
{$agentInfo.name}
{$orderInfo.order_tantou_name}様


この度は弥生Webオーダーをご利用頂き、誠にありがとうございます。

{if $mailCase == 'REG_REPORT' }
以下のご注文はご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信済み
です。下記承認期限までに「承認」頂ければご注文の受付完了です。

◆承認期限：{$ago2week|date_format:"%Y"}年{$ago2week|date_format:"%m"}月{$ago2week|date_format:"%d"}日 15時

「否認」の場合や上記期限までに「承認」頂けない場合、ご注文はキャンセルされます。

※承認状況はこちらでご確認下さい
https://{$server_name}{$url_doc_root}
{/if}

今回のご注文の内容です。
ご注文受付日　：{$regDate|date_format:"%Y"}年{$regDate|date_format:"%m"}月{$regDate|date_format:"%d"}日
ご注文受付番号：{$orderSeq}
--------------------------------------------------------------------
{foreach from=$basketList item=basketlist}
貴社発注No　　：{$basketlist.cust_order_num}
商品コード　　：{$basketlist.product_code}
商品名　　　　：{$basketlist.item_name_kanji}
ご注文数量　　：{$basketlist.count}
ご提供価格　　：￥{$basketlist.price_invoice_price|number_format|string_format:"%7s"}
金額　　　　　：￥{math equation="x * y" x=$basketlist.price_invoice_price y=$basketlist.count format="%7s"}
{if $basketlist.tax_rate != ""}消費税率　　　：{math equation="x * 100" x=$basketlist.tax_rate format="%d"}%{/if} 

{/foreach}
--------------------------------------------------------------------
　　　小計　：￥{$order_amt|number_format|string_format:"%9s"}
　　消費税　：￥{$tax|number_format|string_format:"%9s"}
　合計金額　：￥{$total_amt|number_format|string_format:"%9s"}
--------------------------------------------------------------------
{include file="weborder/common/tax10_comment_mail.tpl"}

伝票送付先 [納品書][請求書]
送付先名称　：{$agentInfo.name}
送付先郵便番号：{$agentInfo.zip}
送付先住所　　：{$agentInfo.pref}{$agentInfo.address1}{$agentInfo.address2}{$agentInfo.address3}
送付先担当者名：{$agentInfo.personName}　様
送付先電話番号：{$agentInfo.tel}
--------------------------------------------------------------------
■お問い合わせ先■
弥生株式会社  受注管理課
TEL    ： 03-5207-8730
FAX    ： 03-5207-8731
E-MAIL ： order-center@yayoi-kk.co.jp
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
