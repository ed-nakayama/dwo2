{if TAX_MSG_FLAG == 1 && $weborderheader.careful_flag != "" }
�����ǤˤĤ���
{if $weborderheader.contents_type == "54" || $weborderheader.contents_type == "55" }
�����󤷤��ݼ饵�ݡ��ȤΥ��åץ��졼�ɤϤ��������������1�������ˤ�����ˡ����Ψ�ˤƲ��Ǥ����Ƥ��������ޤ���
���ܤ����� {$smarty.const.UPGRADE_TAX_URL} �򤴻��Ȥ���������
{else}
�����ץ饤���ʡ��������ʡʥ��եȥ������ˤϾ��ʽвٻ��ˤ�����ˡ����Ψ�ˤƲ��Ǥ����Ƥ��������ޤ���
{if $weborderheader.careful_flag == 1 }
{if $weborderheader.contents_type == "80" || $weborderheader.contents_type == "82" }
�����󤷤��ݼ饵�ݡ��Ȥ�ͭ�����ݡ��ȳ������ˤ�����ˡ����Ψ�ˤƲ��Ǥ����Ƥ��������ޤ���
���������Τ����͡ʥ桼������Ͽ�Τ����͡ˤΡ֤���ǧ�פ��٤줿��硢�嵭�Ȥϰۤʤ��ǳۤǤ����᤹���礬�������ޤ���
���ܤ����� {$smarty.const.PRODUCT_TAX_URL} �򤴻��Ȥ���������
{/if}
{/if}
{/if}
{/if}