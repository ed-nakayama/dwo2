<html>
<head>
<title>ユーザー登録済み製品</title>
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
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</div>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderOrderCompletion" value="true">
	<input type="hidden" name="cust_id" value="{%$form.cust_id%}">
</form>

<br />
<table border="0">
	<tr>
		<td>
		<h4 class="select">▼買い物かご確認</h4>
		</td>
	</tr>
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0">
			<tr>
				<td class="item" width="80px" align="center">商品コード</td>
				<td class="item" width="400px" align="center">商品名称</td>
				<td class="item" width="60px" align="center">{%if $session.orderinfo.upgrade_order == TRUE %}定価{%else%}参考価格{%/if%}</td>
				<td class="item" width="50px" align="center">提供価格</td>
				<td class="item" width="30px" align="center">数量</td>
				<td class="item" width="60px" align="center">金額</td>
			</tr>
			<tr>
				<td width="80px" align="center">{%$session.second_total_sp_item_cd%}</td>
				<td width="400px" align="left" rowspan="2">&nbsp;{%$session.soft_name%}<br>&nbsp;
				（トータル{% if ($session.month_num >= 12) %}12{% else %}{%$session.month_num%}{%/if%}ヶ月分）
				</td>
				<td width="60px" align="right">\&nbsp;{%$session.upgrade_sale_price|number_format%}</td>
				<td class="discount" width="50px" align="right">\&nbsp;{%$session.upgrade_discount_price|number_format%}</td>
				<td width="30px" align="center">&nbsp;1&nbsp;</td>
				<td width="60px" align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="right" width="100%">
			<table border="0" cellspacing="0" width="100%">
			<tr>
				<td align="left" width="77%">
				</td>
				<td width="23%">
					<table class="select" border="1" cellspacing="0" width="100%">
{%*
					<tr>
						<td class="item" width="35%">消費税</td>
						<td align="right" width="65%">\&nbsp;{%$session.upgrade_tax|number_format%}</td>
					</tr>
					<tr>
						<td class="item">合計</td>
						<td align="right">\&nbsp;{%$session.upgrade_total_price|number_format%}</td>
					</tr>
*%}
					<tr>
						<td class="item">合計(税抜)</td>
						<td align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td  width="77%">　</td>
				<td align="right">（別途消費税）</td>
			</tr>
			</table>

		</td>
	</tr>

{%if ($form.ratezeroflag)%}
	<tr>
		<td colspan="2" align="center">
		<br><font color="#FF0000">販売店様の提供価格の仕切率が設定されておりません。<br>
		管理者へご連絡くださるようにお願いいたします。 </font><br><br>
		<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
		</td>
	</tr>
{%*
{%elseif !($form.creditflag)%}
	<tr>
		<td colspan="2" align="center">
		<br><font color="#FF0000">取引猶予額を超えるご注文はできません。 </font><br><br>
		<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
		</td>
	</tr>
*%}
{% else %}
	<tr>
		<td><br>
			<h4 class="select">▼ご注文の流れ</h4>
		</td>
	</tr>
	<tr>
		<td align="center">
			<img src="img/upgradeprocedure.png"/>
			<br>
			<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
			<a href="?action_weborderOrderUpgradedetail=t"><img src="../img/next.png" alt="次へ" width="120px" height="50px"></a>
		</td>
	</tr>	
</table>

{%/if%}
{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

