<html>
<head>
<title>���[�U�[�o�^�ςݐ��i</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">

<script type="text/javascript">
<!--
	function printPreview() {
		document.frmPrt.submit();
	}
-->
</script>

</head>
<body onload="printPreview();">
<center>
<div id="main">

{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
{%include file="weborder/common/userinfo.tpl"%}
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</div>

<form name="frmPrt" action="{%$script%}" method="post" style="margin:0px;" target="_blank">
	<input type="hidden" name="action_weborderOrderUpgradeprint" value="true">
	<input type="hidden" name="print_order_num" value="{%$session.ORDER_SEQ_NO%}">
</form>

<br /><table width="550px">
	<tr>
		<td>
		<br /><h4 class="select">���I�[�_�[����</h4>
		</td>
	</tr>
</table>

<table>

{% if $session.orderinfo.syonin_mail_flg == "1"%}
	<tr>
		<td>
		���������������܂��Đ��ɂ��肪�Ƃ��������܂��B<br />
		<span id="essential"><b>�u�����m�F���v��������A�����������茳�ɓ͂��܂ŕK���ۊǂ��Ă��������B</b></span><br /><br />
<pre>
<span id="essential">��</span>���w���̂��q�l�i���[�U�[�o�^�̂��q�l�j�Ɂu�l���ی���j�v�ɂ��Ă̏��F�m�F���[���𑗐M���܂����B
�@������Q�T�Ԉȓ��Ɂu���F�v���Ă���������΂������̎󂯕t�����������܂��B
�@�u�۔F�v�̏ꍇ�A�������̓L�����Z������܂��B
</pre>
<br /><br />
		</td>
	</tr>
{%else%}
	<tr>
		<td>
		���������������܂��Đ��ɂ��肪�Ƃ��������܂��B<br /><br />
		<span id="essential"><b>�u�����m�F���v��������A�����������茳�ɓ͂��܂ŕK���ۊǂ��Ă��������B</b></span><br /><br />
		</td>
	</tr>
{%/if%}

	<tr>
		<td align="center">
		����tNo.&nbsp;{%$session.ORDER_SEQ_NO%}��<br /><br />
		</td>
	</tr>
</table>

<table border="0" width="700">
	<tr>
		<td width="40%">&nbsp;</td>
		<td align="center">
			<a href="javascript:printPreview();"><img src="../img/print.png" alt="�����m�F��" width="120px" height="50px"></a>
		</td>
		<td width="40%" align="right" valign="bottom"><a href="?action_weborderSelorder=t">���̂���������͂���ꍇ�͂�����</a></td>
	</tr>
</table>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

