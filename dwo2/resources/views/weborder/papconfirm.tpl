<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>購入方法選択</title>
</head>
<body topmargin="0">
<center>
<div id="main">
{%include file="weborder/common/header.tpl"%}

{%include file="weborder/common/menu.tpl"%}

<table width="550px">
	<tr>
		<td>
		<h4>▼下記のPAP会員を設定します。よろしければ次へ進んでください。</h4>
		</td>
	</tr>
</table>

<form name="frm" action="{%$script%}" method="post" style="margin:0px">
	<input type="hidden" name="action_weborderPapconfirmDo" value="true">
	<input type="hidden" name="pap_acc_num" value="{%$app.OriconPap.accountNum%}">

<table border="0">
	<tr>
		<td class="search">PAP会員情報</td>
	</tr>
	<tr>
		<td align="center">
			<table class="select" width="450px" border="1" cellspacing="1" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">事業所名</td>
					<td>{%$app.OriconPap.name%}</td>
				</tr>
				<tr>
					<td class="item">担当者名</td>
					<td>{%$app.OriconPap.personName%}</td>
				</tr>
{%* 弥生１３対応 2012/10/31 *%}
{%if (($session.orderinfo.cust_kbn == 'OR') && ($session.orderinfo.pap_order == TRUE)) %}
				<tr>
					<td class="item">会員種別</td>
					<td>{%$app.memberTypeName%}</td>
				</tr>
{%/if%}
			</table>
		</td>
	</tr>
</table>

<br>
<table>
	<tr>
		<td colspan="2" align="center"><br>
			<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
			<a href="javascript:document.frm.submit();"><img src="../img/next.png" alt="次へ" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

</form>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>