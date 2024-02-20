<html>
<head>
	<title>ユーザー登録済み製品 or 通常製品</title>
	<link rel="stylesheet"type="text/css"href="../css/common.css">
</head>

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
	<input type="hidden" name="action_weborderCustinfoUpgradeinp" value="true">
	<input type="hidden" name="orderDetailSubmit" value="on">

<br /><table border="0">
	<tr>
		<td>
		<h4>▼オーダー詳細入力</h4>
		</td>
	</tr>
	<tr>
		<td>
		<span id="essential">※</span>入力項目のご説明は<a href="?action_weborderOrderUpgradenotes=t">こちら</a><br />
		</td>
	</tr>
	<tr>
		<td>
			<br /><table class="select" border="1" cellspacing="0">
				<tr>
					<td nowrap class="item">貴社発注No.&nbsp;[20桁/半角]</td>
					<td nowrap class="item">商品コード</td>
					<td nowrap class="item" width="300px" align="center">商品名称</td>
					<td nowrap class="item" width="50px" align="center">{%if $session.orderinfo.upgrade_order == TRUE || ($session.orderinfo.cust_kbn != "OR" && $session.orderinfo.cust_kbn != "YBP") %}定価{%else%}参考価格{%/if%}</td>
					<td nowrap class="item" width="50px">提供価格</td>
					<td nowrap class="item" width="30px">数量</td>
					<td nowrap class="item" width="50px" align="center">金額</td>
				<tr>
				<tr>
					<td><input type="text" size="20" maxlength="20" 
						name="frm_cust_order_num" value="{%$session.cust_order_num%}"></td>
					<td nowrap align="center">{%$session.second_total_sp_item_cd%}</td>
					<td width="400px" align="left" rowspan="2">&nbsp;{%$session.soft_name%}<br>&nbsp;
					（トータル{% if ($session.month_num >= 12) %}12{% else %}{%$session.month_num%}{%/if%}ヶ月分）
					</td>
					<td nowrap align="right">\&nbsp;{%$session.upgrade_sale_price|number_format%}</td>
					<td nowrap class="discount" align="right">\&nbsp;{%$session.upgrade_discount_price|number_format%}</td>
					<td nowrap align="center">&nbsp;1&nbsp;</td>
					<td nowrap align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
				<tr>
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
</table>

<br />

<table width="730px" border="0">
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item">貴社ご発注　担当者&nbsp;[8桁/全角]</td>
				<td><input type="text" size="28" maxlength="8" name="frm_order_tantou_name" 
					value="{%$session.order_tantou_name%}"></td>
			</tr>
			<tr>
				<td class="item">備考&nbsp;[32桁/全角]</td>
				<td><input type="text" size="50" maxlength="32" name="frm_remarks" 
					value="{%$session.remarks%}"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>

{%if $errors%}
<table>
	<tr>
		<td align="center">
			{%foreach from=$errors item=error%}
          		<font color=red><li>{%$error%}</font></li>
			{%/foreach%}
		</td>
	</tr>
</table>
{%/if%}

<table>
	<tr>
		<td align="center">
		<div id="next">
			<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
			<a href="javascript:document.frm.submit();"><img src="../img/next.png" alt="次へ" width="120px" height="50px"></a></div>
		</td>
	</tr>
</table>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>