From: {$mailFrom}
Subject: [����No.{$orderSeq}]����������� Web�������� ������ǧ��ǧ
{if $mailBcc!=""}
Bcc: {$mailBcc}
{/if}
X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender

������������������������������������
{$orderInfo.name1}{$orderInfo.name2}
{$orderInfo.contact_name1}��
{$agentInfo.name}��{$orderInfo.dwo_order_person_name}���ͤ�겼������ʸ�򾵤�ޤ�����

����ʸ����������{$regDate|date_format:"%Y"}ǯ{$regDate|date_format:"%m"}��{$regDate|date_format:"%d"}��
����ʸ�����ֹ桧{$orderSeq}
--------------------------------------------------------------------
{foreach from=$basketList item=basketlist}
����ȯ��No������{$basketlist.remarks}
���ʥ����ɡ�����{$basketlist.item_cd}
����̾����������{$basketlist.item_name_kanji}
����ʸ���̡�����{$basketlist.item_vol}

{/foreach}
����URL���ָĿ;����ݸ����ˡפˤĤ��Ƥ���ǧ�Τ�������ǧ�ξ��ϡ־�ǧ�ץܥ���򥯥�å����Ƥ���������
������ǧ�פ򥯥�å��������ϡ����ʤ���ʸ�ʤ�Ӥ˥桼������Ͽ����Ϻ������ޤ���

https://{$server_name}{$url_doc_root}?action_weborderRecognizeTop=t&id={$acceptance_seq}&aid={$syonin_id}

--------------------------------------------------------------------
�����䤤��碌�袣
�����������  ���������
TEL    �� 03-5207-8730
FAX    �� 03-5207-8731
E-MAIL �� order-center@yayoi-kk.co.jp
�������������������������������������
