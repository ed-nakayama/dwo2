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

{%if $errors%}
<table align="center">
	<tr>
		<td align="left">
			{%foreach from=$errors item=error%}
          		<font color=red><li>{%$error%}</font></li>
			{%/foreach%}
		</td>
	</tr>
</table>
{%/if%}

<p class="words">
�߂�{�^���őO��ʂɖ߂�A���������q�l������͂��Ă��������B<br /><br />
</p>

<br /><br />

<table border="0" cellspacing="0">
	<tr>
		<td align="center" colspan="2">
			<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>
