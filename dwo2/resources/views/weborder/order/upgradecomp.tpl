<html>
<head>
<title>ユーザー登録済み製品</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">

<script type="text/javascript">
<!--
	function printPreview() {
		document.frmPrt.submit();
	}
-->
</script>

</head>
<body onload="printPreview();">
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

<form name="frmPrt" action="{%$script%}" method="post" style="margin:0px;" target="_blank">
	<input type="hidden" name="action_weborderOrderUpgradeprint" value="true">
	<input type="hidden" name="print_order_num" value="{%$session.ORDER_SEQ_NO%}">
</form>

<br /><table width="550px">
	<tr>
		<td>
		<br /><h4 class="select">▼オーダー完了</h4>
		</td>
	</tr>
</table>

<table>

{% if $session.orderinfo.syonin_mail_flg == "1"%}
	<tr>
		<td>
		ご注文いただきまして誠にありがとうございます。<br />
		<span id="essential"><b>「注文確認書」を印刷し、請求書がお手元に届くまで必ず保管してください。</b></span><br /><br />
<pre>
<span id="essential">※</span>ご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信しました。
　到着後２週間以内に「承認」していただければご注文の受け付けが完了します。
　「否認」の場合、ご注文はキャンセルされます。
</pre>
<br /><br />
		</td>
	</tr>
{%else%}
	<tr>
		<td>
		ご注文いただきまして誠にありがとうございます。<br /><br />
		<span id="essential"><b>「注文確認書」を印刷し、請求書がお手元に届くまで必ず保管してください。</b></span><br /><br />
		</td>
	</tr>
{%/if%}

	<tr>
		<td align="center">
		■受付No.&nbsp;{%$session.ORDER_SEQ_NO%}■<br /><br />
		</td>
	</tr>
</table>

<table border="0" width="700">
	<tr>
		<td width="40%">&nbsp;</td>
		<td align="center">
			<a href="javascript:printPreview();"><img src="../img/print.png" alt="注文確認書" width="120px" height="50px"></a>
		</td>
		<td width="40%" align="right" valign="bottom"><a href="?action_weborderSelorder=t">次のご注文を入力する場合はこちら</a></td>
	</tr>
</table>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

