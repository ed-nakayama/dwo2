<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>お客様の情報</title>
</head>
<body topmargin="0">
<center>
<div id="main">
{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<table width="550px">
	<tr>
		<td align="center">
		<h4>▼顧客の情報</h4>
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

<table border="1" cellspacing="0" frame="hsides" rules="rows" width="370px">
	<tr>
		<td class="item" width="40%">使用者顧客名</td>
		<td width="60%">&nbsp;{%$form.customer%}</td>
	</tr>
	<tr>
		<td class="item">所有製品名</td>
		<td >&nbsp;{%$form.itemname%}</td>
	</tr>
	<tr>
		<td class="item">現在のサポートプラン名</td>
		<td >&nbsp;{%$form.supportplan%}&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td class="item">サポート期限</td>
		<td >&nbsp;{%$form.enddate%}&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td class="item">サポート区分</td>
		<td >&nbsp;{%$form.supporttype%}&nbsp;&nbsp;</td>
	</tr>

	<tr>
		<td colspan="2" align="center"><br>
		<font color="#FF0000">このお客様でいいですか？</font><br><br>
		<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
		<a href="javascript:document.frm.submit();"><img src="../img/next.png" alt="次へ" width="120px" height="50px"></a>
	</td>
	</tr>

</table>
</form>

<table border="0" cellspacing="0" frame="hsides" rules="rows" width="360px">
<tr><td align="center">
<font color="#5050D0">※名義変更をご希望の場合は<a href="changeuser.pdf">こちら</a>から「名義変更申請書」をダウンロードし、
ご記入・送付をお願いします。</font>
</td></tr>
</table>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>