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

<table width="550px">
	<tr>
		<td>
		<h4>▼注文のご確認</h4>
		</td>
	</tr>
</table>

<p class="words">
<span id="essential">買い物かごに商品がありません。</span><br />
既に注文済みの場合は、<a href="index.php?action_weborderTopHistory2search=t" target="_blank">注文履歴</a>で注文内容のご確認が可能です。<br /><br />
</span>
</p>

<br /><br />

<form name="frm" action="index.php" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHome" value="true">
	<input type="hidden" name="frm_regist" value="">
	<table border="0" cellspacing="0">
		<tr>
			<td align="center" colspan="2">
				<a href="javascript:document.frm.submit();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
			</td>
		</tr>
	</table>
</form>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>
