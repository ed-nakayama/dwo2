<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>�w�����@�I��</title>
</head>
<body topmargin="0">
<center>
<div id="main">
{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<table width="550px">
	<tr>
		<td>
		<h4>���o�`�o��p���i���󒍂����o�`�o����R�[�h����͂��Ă��������B</h4>
		</td>
	</tr>
{%if count($errors)%}
{%foreach from=$errors item=error%}
	<tr>
		<td align="center">
          <font color=red><li>{%$error%}</font></li>
		</td>
	<tr>
{%/foreach%}
{%/if%}
</table>


<form name="frm" action="{%$script%}" method="post" style="margin:0px">
<input type="hidden" name="action_weborderUpgrpapinput" value="true">

<table>
	<tr>
		<td>PAP����ԍ�</td>
		<td><input type="text" name="pap_acc_num" value="{%$form.pap_acc_num%}" maxlength="9" style="ime-mode: disabled;"></td>
	</tr>
	<tr>
		<td>�g�p�҂̂��q�l�ԍ�</td>
		<td><input type="text" name="cust_num" value="{%$form.cust_num%}" maxlength="9" style="ime-mode: disabled;"></td>
	</tr>
	<tr>
		<td>�g�p�҂̓d�b�ԍ�</td>
		<td><input type="text" name="cust_tel" value="{%$form.cust_tel%}" maxlength="9" style="ime-mode: disabled;"></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br>
			<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
			<a href="javascript:document.frm.submit();"><img src="../img/next.png" alt="����" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

</form>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>