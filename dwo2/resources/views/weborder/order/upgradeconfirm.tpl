<html>
<head>
<title>���[�U�[�o�^�ςݐ��i</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">
<script type="text/javascript">
<!--
	function registration() {
		document.frm.frm_regist.value = "EXEC";
		document.frm.submit();
	}
-->
</script>
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
	<input type="hidden" name="action_weborderOrderUpgradecomp" value="true">
	<input type="hidden" name="frm_regist" value="">
</form>

<br />
<table border="0">
	<tr>
		<td>
		<h4 class="select">���I�[�_�[�m�F</h4>
		</td>
	</tr>
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0">
			<tr>
				<td class="item" width="70px" align="center">���i�R�[�h</td>
				<td class="item" width="300px" align="center">���i����</td>
				<td class="item" width="50px" align="center">{%if $session.orderinfo.upgrade_order == TRUE || ($session.orderinfo.cust_kbn != "OR" && $session.orderinfo.cust_kbn != "YBP") %}�艿{%else%}�Q�l���i{%/if%}</td>
				<td class="item" width="50px" align="center">�񋟉��i</td>
				<td class="item" width="30px" align="center">����</td>
				<td class="item" width="50px" align="center">���z</td>
			</tr>
			<tr>
				<td width="70px" align="center">{%$session.second_total_sp_item_cd%}</td>
				<td width="300px" align="left">{%$session.soft_name%}<br>&nbsp;
				�i�g�[�^��{% if ($session.month_num >= 12) %}12{% else %}{%$session.month_num%}{%/if%}�������j</td>
				<td width="50px" align="right">\&nbsp;{%$session.upgrade_sale_price|number_format%}</td>
				<td class="discount" width="50px" align="right">\&nbsp;{%$session.upgrade_discount_price|number_format%}</td>
				<td width="30px" align="center">&nbsp;1&nbsp;</td>
				<td width="50px" align="right">\&nbsp;{%$session.upgrade_price|number_format%}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="right">
			<table class="select" border="1" cellspacing="0" width="170px">
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
		<td align="right">�i�ʓr����Łj</td>
	</tr>
</table>

<table border="0">
	<tr>
		<td>
{%include file="weborder/common/tax_comment.tpl"%}
		</td>
	</tr>
	<tr>
		<td>
			���p�[�g�i�[����l�ւ̒��ӎ�����<br />
			���������e����шȉ��̃��[�U�[�o�^�������m�F�������B<br />
{%if $session.orderinfo.cust_kbn == "OR" || $session.orderinfo.cust_kbn == "YBP" %}
			���w���̂��q�l�i���[�U�[�o�^�̂��q�l�j�Ɂu�l���ی���j�v�ɂ��Ă̏��F�m�F���[���𑗐M���܂��B<br />
			�����F��u�����m��v�ƂȂ�܂��B<br /><br />
{%/if%}
		</td>
	</tr>
	<tr>
		<td class="search">�����[�U�[���</td>
	</tr>
	<tr>
		<td align="center">
		<br /><table class="select" width="450px" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="200px">�o�^���`</td>
				<td>{%$app.orderinfo.regist_name%}</td>
			</tr>
			<tr>
				<td class="item">�o�^���`(�t���K�i)</td>
				<td>{%$app.orderinfo.regist_kana%}</td>
			</tr>
			<tr>
				<td class="item">��\������܂��͑�\��</td>
				<td>{%$app.orderinfo.regist_ceo%}</td>
			</tr>
			<tr>
				<td class="item">��\������܂��͑�\��(�t���K�i)</td>
				<td>{%$app.orderinfo.regist_ceo_kana%}</td>
			</tr>
			<tr>
				<td class="item">�S����</td>
				<td>{%$app.orderinfo.regist_name_of_charge%}</td>
			</tr>
			<tr>
				<td class="item">�S����(�t���K�i)</td>
				<td>{%$app.orderinfo.regist_name_of_charge_kana%}</td>
			</tr>
			<tr>
				<td class="item">���[���A�h���X</td>
				<td>{%$app.orderinfo.regist_mail%}</td>
			</tr>
			<tr>
				<td class="item">�z�[���y�[�WURL</td>
				<td>{%$app.orderinfo.regist_url%}</td>
			</tr>
			<tr>
				<td class="item">�X�֔ԍ�</td>
				<td>{%$app.orderinfo.regist_zip1%}-{%$app.orderinfo.regist_zip2%}</td>
			</tr>
			<tr>
				<td class="item">�s���{��</td>
				<td>{%$app.orderinfo.regist_pref%}</td>
			</tr>
			<tr>
				<td class="item">�s�撬��</td>
				<td>{%$app.orderinfo.regist_add1%}</td>
			</tr>
			<tr>
				<td class="item">���Ԓn</td>
				<td>{%$app.orderinfo.regist_add2%}</td>
			</tr>
			<tr>
				<td class="item">������</td>
				<td>{%$app.orderinfo.regist_add3%}</td>
			</tr>
			<tr>
				<td class="item">�o�^�d�b�ԍ�</td>
				<td>{%$app.orderinfo.regist_tel1%}-{%$app.orderinfo.regist_tel2%}-{%$app.orderinfo.regist_tel3%}</td>
			</tr>
			<tr>
				<td class="item">�A����d�b�ԍ�</td>
				<td>
					{%if $app.orderinfo.regist_contact_tel1 != ""%}
					{%$app.orderinfo.regist_contact_tel1%}-{%$app.orderinfo.regist_contact_tel2%}-{%$app.orderinfo.regist_contact_tel3%}
					{%/if%}
				</td>
			</tr>
			<tr>
				<td class="item">�A����FAX�ԍ�</td>
				<td>
					{%if $app.orderinfo.regist_contact_fax1 != ""%}
					{%$app.orderinfo.regist_contact_fax1%}-{%$app.orderinfo.regist_contact_fax2%}-{%$app.orderinfo.regist_contact_fax3%}
					{%/if%}
				</td>
			</tr>
			</table><br />
		</td>
	</tr>

	<tr>
		<td>
		���e���m�F������u�m��v�{�^�����N���b�N���ē��͓��e���m�肵�Ă��������B<br />
{%if $session.orderinfo.cust_kbn == "OR" || $session.orderinfo.cust_kbn == "YBP" %}
		���w���̂��q�l�i���[�U�[�o�^�̂��q�l�j�Ɂu�l���ی���j�v�ɂ��Ă̏��F�m�F���[���𑗐M���܂��B<br />
		�����F��<span id="essential">�u�����m��v</span>�ƂȂ�܂��B<br />
{%/if%}
		���e�ɕύX���������܂�����A�u�߂�v�{�^���œ��͉�ʂ܂Ŗ߂��ĕύX���Ă��������B<br /><br />

		<span id="essential"><b>���m���̒ǉ��E�ύX�͂ł��܂���̂ł����ӂ��������B</b></span><br />
		�ߌ�3���܂ł́u���������v��育�����폜���\�ł��B<br />
		�m���̓��e�ɂ��܂��ẮA�u���������v��ʂɂĂ��m�F���������B<br /><br />
		<br /><br />
		</td>
	</tr>
</table>

<div id="next">
	<a href="javascript:history.back();"><img src="img/back.png" alt="�߂�" width="120px" height="50px"></a>
	<a href="javascript:registration();"><img src="img/decision.png" alt="�m��" width="120px" height="50px"></a>
</div>


{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

