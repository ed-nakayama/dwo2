<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>���q�l�̏��</title>
</head>
<body topmargin="0">
<center>
<div id="main">
{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<table width="550px">
	<tr>
		<td align="center">
		<h4>�����q�l���</h4>
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

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHomeupgrade" value="true">
	<input type="hidden" name="cust_id" value="{%$form.cust_id%}">
	<input type="hidden" name="basic_item_cd" value="{%$form.basic_item_cd%}">
<table border="1" cellspacing="0" frame="hsides" rules="rows" height="300px" width="450px">
{%if $form.secondflag%}
	<tr>
		<td class="item" width="40%">�Q���X����</td>
		<td width="60%">&nbsp;{%$form.secondpap%}</td>
	</tr>
{%/if%}
	<tr>
		<td class="item" width="40%">�g�p�Ҍڋq��</td>
		<td width="60%">&nbsp;{%$form.customer%}</td>
	</tr>
	<tr>
		<td class="item">���L���i��</td>
		<td >&nbsp;{%$form.itemname%}</td>
	</tr>
	<tr>
		<td class="item">���݂̃T�|�[�g�v������</td>
		<td >&nbsp;{%$form.supportplan%}&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td class="item">�T�|�[�g�L������</td>
		<td >&nbsp;{%$form.enddate%}&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td class="item">�T�|�[�g�c����</td>
		<td >&nbsp;{%$form.monthnum%}����</td>
	</tr>
	<tr>
		<td class="item">�T�|�[�g�A�b�v�O���[�h���z�敪</td>
		<td >&nbsp;{%$form.supporttype%}&nbsp;&nbsp;</td>
	</tr>
	
{%if !($form.enableflag)%}
	<tr>
		<td colspan="2" align="center">
		<br><font color="#FF0000">��L�̏��L���i�E���C�Z���X�̓A�b�v�O���[�h�̑ΏۂɂȂ�܂���B</font><br><br>
		<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
		</td>
	</tr>
{% else %}
	<tr>
		<td colspan="2" align="center"><br>
			<font color="#FF0000">���̂��q�l�ł�낵���ł����H</font><br><br>
			<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
			<a href="javascript:document.frm.submit();"><img src="../img/next.png" alt="����" width="120px" height="50px"></a>
		</td>
	</tr>
{%/if%}
</table>
</form>

<table border="0" cellspacing="0" frame="hsides" rules="rows" width="400px">
<tr><td align="center">
<font color="red">�����`�ύX������]�̏ꍇ</font><br>
���`�ύX�葱�����K�v�ƂȂ�܂��̂ŁA�󒍊Ǘ��ۂ܂ł��A�����������B<br>
�i���₢���킹�� �F TEL�@03-5207-8730�j<br>
<!--
<a href="changeuser.pdf">������</a>
����u���`�ύX�\�����v���_�E�����[�h���A���L���E���t�����肢���܂��B</font>
-->
<br><br>
</td></tr>
</table>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>