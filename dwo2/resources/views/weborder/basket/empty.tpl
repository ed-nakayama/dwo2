<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=shift_jis">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<title>�퐶 Web Order</title>
</head>
<body topmargin="0">
<center>
<div id="main">
{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<table width="550px">
	<tr>
		<td>
		<h4>�������̂��m�F</h4>
		</td>
	</tr>
</table>

<p class="words">
<span id="essential">�����������ɏ��i������܂���B</span><br />
���ɒ����ς݂̏ꍇ�́A<a href="index.php?action_weborderTopHistory2search=t" target="_blank">��������</a>�Œ������e�̂��m�F���\�ł��B<br /><br />
</span>
</p>

<br /><br />

<form name="frm" action="index.php" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHome" value="true">
	<input type="hidden" name="frm_regist" value="">
	<table border="0" cellspacing="0">
		<tr>
			<td align="center" colspan="2">
				<a href="javascript:document.frm.submit();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
			</td>
		</tr>
	</table>
</form>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>
