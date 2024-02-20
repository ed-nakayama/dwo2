From: {$mailFrom}
Subject: [受付No.{$orderSeq}]弥生株式会社 Webオーダー 購入承認確認
{if $mailBcc!=""}
Bcc: {$mailBcc}
{/if}
X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
{$orderInfo.name1}{$orderInfo.name2}
{$orderInfo.contact_name1}様
{$agentInfo.name}　{$orderInfo.dwo_order_person_name}　様より下記ご注文を承りました。

ご注文受付日　：{$regDate|date_format:"%Y"}年{$regDate|date_format:"%m"}月{$regDate|date_format:"%d"}日
ご注文受付番号：{$orderSeq}
--------------------------------------------------------------------
{foreach from=$basketList item=basketlist}
貴社発注No　　：{$basketlist.remarks}
商品コード　　：{$basketlist.item_cd}
商品名　　　　：{$basketlist.item_name_kanji}
ご注文数量　　：{$basketlist.item_vol}

{/foreach}
下記URLより「個人情報保護方針」についてご確認のうえ、承認の場合は「承認」ボタンをクリックしてください。
※「否認」をクリックした場合は、商品の注文ならびにユーザー登録情報は削除されます。

https://{$server_name}{$url_doc_root}?action_weborderRecognizeTop=t&id={$acceptance_seq}&aid={$syonin_id}

--------------------------------------------------------------------
■お問い合わせ先■
弥生株式会社  受注管理課
TEL    ： 03-5207-8730
FAX    ： 03-5207-8731
E-MAIL ： order-center@yayoi-kk.co.jp
＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
