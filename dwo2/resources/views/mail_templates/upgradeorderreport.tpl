From: {$mailFrom}
{if $mailCase == 'REG_REPORT' }
Subject: ������Web���������۾�ǧ��ǧ�᡼���ۿ��Τ��Τ餻[����No.{$orderSeq}]
{else}
Subject: ������Web���������ۤ���ʸ���մ�λ�Τ��Τ餻[����No.{$orderSeq}]
{/if}
{if $mailBcc!=""}
Bcc: {$mailBcc}
{/if}
X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender

������������������������������������
{$agentInfo.name}
{$orderInfo.order_tantou_name}��


�����٤�����Web��������������ĺ�������ˤ��꤬�Ȥ��������ޤ���

{if $mailCase == 'REG_REPORT' }
�ʲ��Τ���ʸ�Ϥ������Τ����͡ʥ桼������Ͽ�Τ����͡ˤˡָĿ;����ݸ����ˡפˤĤ��Ƥξ�ǧ��ǧ�᡼��������Ѥ�
�Ǥ���������ǧ���¤ޤǤˡ־�ǧ��ĺ����Ф���ʸ�μ��մ�λ�Ǥ���

����ǧ���¡�{$ago2week|date_format:"%Y"}ǯ{$ago2week|date_format:"%m"}��{$ago2week|date_format:"%d"}�� 15��

����ǧ�פξ���嵭���¤ޤǤˡ־�ǧ��ĺ���ʤ���硢����ʸ�ϥ���󥻥뤵��ޤ���

����ǧ�����Ϥ�����Ǥ���ǧ������
https://{$server_name}{$url_doc_root}
{/if}

����Τ���ʸ�����ƤǤ���
����ʸ����������{$regDate|date_format:"%Y"}ǯ{$regDate|date_format:"%m"}��{$regDate|date_format:"%d"}��
����ʸ�����ֹ桧{$orderSeq}
--------------------------------------------------------------------
{foreach from=$basketList item=basketlist}
����ȯ��No������{$basketlist.cust_order_num}
���ʥ����ɡ�����{$basketlist.product_code}
����̾����������{$basketlist.item_name_kanji}
����ʸ���̡�����{$basketlist.count}
���󶡲��ʡ�������{$basketlist.price_invoice_price|number_format|string_format:"%7s"}
��ۡ�������������{math equation="x * y" x=$basketlist.price_invoice_price y=$basketlist.count format="%7s"}
{if $basketlist.tax_rate != ""}������Ψ��������{math equation="x * 100" x=$basketlist.tax_rate format="%d"}%{/if} 

{/foreach}
--------------------------------------------------------------------
���������ס�����{$order_amt|number_format|string_format:"%9s"}
���������ǡ�����{$tax|number_format|string_format:"%9s"}
����׶�ۡ�����{$total_amt|number_format|string_format:"%9s"}
--------------------------------------------------------------------
{include file="weborder/common/tax10_comment_mail.tpl"}

��ɼ������ [Ǽ�ʽ�][�����]
������̾�Ρ���{$agentInfo.name}
������͹���ֹ桧{$agentInfo.zip}
�����轻�ꡡ����{$agentInfo.pref}{$agentInfo.address1}{$agentInfo.address2}{$agentInfo.address3}
������ô����̾��{$agentInfo.personName}����
�����������ֹ桧{$agentInfo.tel}
--------------------------------------------------------------------
�����䤤��碌�袣
�����������  ���������
TEL    �� 03-5207-8730
FAX    �� 03-5207-8731
E-MAIL �� order-center@yayoi-kk.co.jp
�������������������������������������
