From: {$mailFrom}
Subject: 弥生WebOrder：出荷手配中ステータス変更バッチエラー
{if $mailBcc!=""}
Bcc: {$mailBcc}
{/if}
X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender

DWOシステム管理者 様
「Web受注基本」テーブルのステータスを出荷手配中に更新する
バッチ処理にてエラーが発生しました。
オラクルデータベース、ネットワークの状態を確認して下さい。

エラー内容
**********************************************************
{$err_msg}
**********************************************************

再実行する場合は管理画面から実行してください。

======================================
エラー発生時刻：{$batchdate}
======================================
