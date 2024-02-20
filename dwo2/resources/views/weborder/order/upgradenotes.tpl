<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>ユーザー登録済み製品 or 通常製品</title>
</head>
<body>
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

<div id="leftside">
<p>
<h4 class="help">■貴社発注Noについて■</h4><br />
<p class="words">貴社にて管理されている発注Noがあれば[貴社発注No]欄に入力して下さい。<br />
商品ごとの入力が可能です。<br />
なお、弊社納品書に印字される発注№は1行目のみとなります。<br /><br /></p>
<h4 class="help">■貴社ご発注 担当者について■</h4><br />
<p class="words">ご販売店様への納品の場合、貴社ご発注担当者様宛てに納品させていただきます。<br /></p>
<h4 class="help">■備考について■</h4><br />
<p class="words">納品書への記載事項があれば、入力してください。<br /><br />
</div>

<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>