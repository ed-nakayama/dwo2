<html>
<head>
	<title>���[�U�[�o�^�ςݐ��i or �ʏ퐻�i</title>
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
		<h4>���I�[�_�[�ڍד���</h4>
		</td>
	</tr>
	<tr>
		<td>
		<span id="essential">��</span>���͍��ڂ̂�������<a href="?action_weborderOrderUpgradenotes=t">������</a><br />
		</td>
	</tr>
	<tr>
		<td>
			<br /><table class="select" border="1" cellspacing="0">
				<tr>
					<td nowrap class="item">�M�Д���No.&nbsp;[20��/���p]</td>
					<td nowrap class="item">���i�R�[�h</td>
					<td nowrap class="item" width="300px" align="center">���i����</td>
					<td nowrap class="item" width="50px" align="center">{%if $session.orderinfo.upgrade_order == TRUE || ($session.orderinfo.cust_kbn != "OR" && $session.orderinfo.cust_kbn != "YBP") %}�艿{%else%}�Q�l���i{%/if%}</td>
					<td nowrap class="item" width="50px">�񋟉��i</td>
					<td nowrap class="item" width="30px">����</td>
					<td nowrap class="item" width="50px" align="center">���z</td>
				<tr>
				<tr>
					<td><input type="text" size="20" maxlength="20" 
						name="frm_cust_order_num" value="{%$session.cust_order_num%}"></td>
					<td nowrap align="center">{%$session.second_total_sp_item_cd%}</td>
					<td width="400px" align="left" rowspan="2">&nbsp;{%$session.soft_name%}<br>&nbsp;
					�i�g�[�^��{% if ($session.month_num >= 12) %}12{% else %}{%$session.month_num%}{%/if%}�������j
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
						<td class="item" width="35%">�����</td>
						<td align="right" width="65%">\&nbsp;{%$session.upgrade_tax|number_format%}</td>
					</tr>
					<tr>
						<td class="item">���v</td>
						<td align="right">\&nbsp;{%$session.upgrade_total_price|number_format%}</td>
					</tr>
*%}
					<tr>
						<td class="item">���v(�Ŕ�)</td>
						<td align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
					</tr>
		</table>
				</td>
			</tr>
			<tr>
				<td  width="77%">�@</td>
				<td align="right">�i�ʓr����Łj</td>
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
				<td class="item">�M�Ђ������@�S����&nbsp;[8��/�S�p]</td>
				<td><input type="text" size="28" maxlength="8" name="frm_order_tantou_name" 
					value="{%$session.order_tantou_name%}"></td>
			</tr>
			<tr>
				<td class="item">���l&nbsp;[32��/�S�p]</td>
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
			<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
			<a href="javascript:document.frm.submit();"><img src="../img/next.png" alt="����" width="120px" height="50px"></a></div>
		</td>
	</tr>
</table>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>