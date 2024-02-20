<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=shift_jis">
<link rel="stylesheet" type="text/css" href="../css/common.css">
<title>弥生 Web Order</title>
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
戻るボタンで前画面に戻り、正しいお客様情報を入力してください。<br /><br />
</p>

<br /><br />

<table border="0" cellspacing="0">
	<tr>
		<td align="center" colspan="2">
			<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>
