<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<title>メニュー</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">
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
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="50px">
						<p class="submenu">
							<a href="?action_weborderTopCondition=t" target="information">お取引条件</a>
							<a href="?action_weborderTopHistory=t" target="information">注文履歴</a>
							<a href="?action_weborderTopRegistrationinfo=t" target="information">ご登録情報</a>
								{%if $session.orderinfo.pap_order == TRUE %}
										<a href="?action_weborderTopOrdermethod=t">ご注文の流れ</a>
								{%/if%}
						</p>
					</td>
				</tr>
				<tr>
					<td><iframe src="?action_weborderTopCondition=t" height="150" width="380" marginwidth="0px" frameborder="0" name="information"></iframe></td>
				</tr>
				<tr>
					<td align="center"></td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<p class="sidebar" style="width:347px">お知らせ</p>
					</td>
				<tr>
			</table>
			<iframe src="?action_weborderCommonInformation=t" width="360px" height="550px" frameborder="0">
			</iframe>
		</td>
	</tr>
</table>
</div>
<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderBasketUpgradeconfirm" value="true">
	<input type="hidden" name="cust_id" value="{%$form.cust_id%}">
	<input type="hidden" name="basic_item_cd" value="{%$form.basic_item_cd%}">
<div class="next">

<script type="text/javascript"><!--
function on_submit() {
	document.frm.submit();
 }
 // --></script>
{%*<a href="javascript:document.frm.submit();">*%}
<a href="javascript:on_submit();">{%* 2013/10/24 *%}
<img src="img/next.png" alt="次へ" width="120px" height="50px"></a></div>
</form>
{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>