<html>
<head>
<title>���[�U�[�o�^�ςݐ��i</title>
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
		<h4 class="select">�������������m�F</h4>
		</td>
	</tr>
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0">
			<tr>
				<td class="item" width="80px" align="center">���i�R�[�h</td>
				<td class="item" width="400px" align="center">���i����</td>
				<td class="item" width="60px" align="center">{%if $session.orderinfo.upgrade_order == TRUE %}�艿{%else%}�Q�l���i{%/if%}</td>
				<td class="item" width="50px" align="center">�񋟉��i</td>
				<td class="item" width="30px" align="center">����</td>
				<td class="item" width="60px" align="center">���z</td>
			</tr>
			<tr>
				<td width="80px" align="center">{%$session.second_total_sp_item_cd%}</td>
				<td width="400px" align="left" rowspan="2">&nbsp;{%$session.soft_name%}<br>&nbsp;
				�i�g�[�^��{% if ($session.month_num >= 12) %}12{% else %}{%$session.month_num%}{%/if%}�������j
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

{%if ($form.ratezeroflag)%}
	<tr>
		<td colspan="2" align="center">
		<br><font color="#FF0000">�̔��X�l�̒񋟉��i�̎d�ؗ����ݒ肳��Ă���܂���B<br>
		�Ǘ��҂ւ��A����������悤�ɂ��肢�������܂��B </font><br><br>
		<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
		</td>
	</tr>
{%*
{%elseif !($form.creditflag)%}
	<tr>
		<td colspan="2" align="center">
		<br><font color="#FF0000">����P�\�z�𒴂��邲�����͂ł��܂���B </font><br><br>
		<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
		</td>
	</tr>
*%}
{% else %}
	<tr>
		<td><br>
			<h4 class="select">���������̗���</h4>
		</td>
	</tr>
	<tr>
		<td align="center">
			<img src="img/upgradeprocedure.png"/>
			<br>
			<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
			<a href="?action_weborderOrderUpgradedetail=t"><img src="../img/next.png" alt="����" width="120px" height="50px"></a>
		</td>
	</tr>	
</table>

{%/if%}
{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

