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

<table width="672px">
	<tr>
		<td>
		<h4>���w�����@��I�����Ă�������</h4>
		</td>
	</tr>
</table>

<form name="frm" action="{%$script%}" method="post" style="margin:0px">
<input type="hidden" name="action_weborderSelorderDo" value="true">

<table border="0">
	<tr>
		<td width="180px" height="90">
		<img src="img/userorder.png" alt="���[�U�[�o�^�ς݂̕��̂�����" width="180px" height="90" onClick="document.frm.mode[0].checked=true" style="cursor:pointer;">
		</td>
		<td width="50px">
		</td>
		<td width="180px" height="90">
		<img src="img/normalorder.png" alt="�ʏ퐻�i�̂�����" width="180px" height="90" onClick="document.frm.mode[1].checked=true" style="cursor:pointer;">
		</td>
		<td width="50px">
		</td>
	{%if !$form.disagent_upgrade%}
		<td width="180px" height="90">
		{%if !$form.upgradeflag%}
			<img src="img/upgradeorder.png" alt="�T�|�[�g�A�b�v�O���[�h" width="180px" height="90" onClick="document.frm.mode[2].checked=true" style="cursor:pointer;">
		{%else %}
			<img src="img/upgradeorder.png" alt="�T�|�[�g�A�b�v�O���[�h" width="180px" height="90" onClick="document.frm.mode[2].checked=false" style="cursor:pointer;">
		{%/if%}		
		</td>
	{%/if%}		
	</tr>
	<tr>
		<td align="center">
			<input type="radio" name="mode" value="pap" checked>
		</td>
		<td>
		</td>
		<td align="center">
			<input type="radio" name="mode" value="default">
		</td>
		<td>
		</td>
	{%if !$form.disagent_upgrade%}
		<td align="center">
		{%if !$form.upgradeflag%}
			<input type="radio" name="mode" value="upgrade">
		{%else %}
			<input type="radio" name="mode" value="upgrade" disabled>
		{%/if%}
		</td>
	{%/if%}
	</tr>
	<tr>
		<td colspan="5" align="center" height="40px">
		���ߋ�6��������Web�I�[�_�[���������͂ǂ��炩��ł��m�F�ł��܂��B
		</td>
	</tr>
{%if !$form.disagent_upgrade%}
	{%if $form.upgradeflag%}
	<tr>
		<td colspan="5" align="center" height="40px">
		<font color="red">���T�|�[�g�A�b�v�O���[�h�̂������ɂ���</font><br>
�@�@�@�@	�������̊��ԁA�����e�i���X�̂��߂���t���~���Ă���܂��B<br>
�@�@�@�@	�����ȍ~�ɂ����������肢�������܂��B
		</td>
	</tr>
	{%/if%}
{%/if%}
	<tr>
		<td colspan="5" align="center" height="20px">
		</td>
	</tr>
	<tr>
		<td colspan="5" align="center" height="40px">
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