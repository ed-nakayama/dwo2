<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>web�I�[�_�[����</title>

<script type="text/javascript">
<!--
	function printPreview() {
		document.frmPrt.submit();
	}
	function delSubmit() {
		if (window.confirm("���̒������폜���Ă���낵���ł����H")) {
			document.frm.submit();
		}
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
		<td>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
					<p class="sidebar">���m�点</p>
				</td>
			<tr>
		</table>
		<iframe src="?action_weborderCommonInformation=t" width="360px" height="100px" frameborder="0">
		</iframe>
		</td>
	</tr>
</table>
</div>

<form name="frmPrt" action="{%$script%}" method="post" style="margin:0px;" target="_blank">
	<input type="hidden" name="action_weborderOrderPrintview" value="true">
	<input type="hidden" name="print_order_num" value="{%$app.orderheader.web_order_num%}">
</form>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorydeleteDo" value="true">
	<input type="hidden" name="del_order_num" value="{%$app.orderheader.web_order_num%}">
</form>

<form name="frmMailChg" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorymailchg" value="true">
	<input type="hidden" name="chg_order_num" value="{%$app.orderheader.web_order_num%}">
	<input type="hidden" name="old_mail_addr" value="{%$app.orderheader.mail_address%}">
</form>

<br /><table width="550px">
	<tr>
		<td>
		<h4>�������m�F �ڍ�</h4>
		</td>
	</tr>
</table>

{%if count($errors) <= 0%}

<table border="0">
{%if $app.orderheader.delete_ok == 1%}
	<tr>
		<td width="60px"></td>
		<td align="left">
		<span id="essential">��</span>�u�폜�v���N���b�N����ƁA���������L�����Z������܂��B<br />
		</td>
	<tr>
{%/if%}
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item" width="150px">
				���݂̃X�e�[�^�X</td>
				<td width="250px">{%$app.orderheader.state_type_str%}</td>
			</tr>
			<tr>
				<td class="item">��tNo.</td>
				<td>{%$app.orderheader.web_order_num%}</td>
			</tr>
			<tr>
				<td class="item">��t��</td>
				<td>{%$app.orderheader.dwo_last_update%}</td>
			</tr>
			<tr>
				<td class="item">�o�ד�</td>
				<td>
{%if $app.orderheader.shipping_date != ""%}
{%$app.orderheader.shipping_date|date_format:"%Y"%}-{%$app.orderheader.shipping_date|date_format:"%m"%}-{%$app.orderheader.shipping_date|date_format:"%d"%}
{%else%}
&nbsp;
{%/if%}
</td>
			</tr>
			<tr>
				<td class="item">�M�Д����S����</td>
				<td>{%$app.orderheader.dwo_order_person_name%}</td>
			</tr>
			<tr>
				<td class="item">�T�v���C��d����</td>
				<td>{%if $app.orderheader.double_package_type == "1" %}�L{%else%}��{%/if%}</td>
			</tr>
			<tr>
				<td class="item">�[�i�� ����</td>
				<td>{%$app.orderheader.dest_name1%}{%$app.orderheader.dest_name2%}</td>
			</tr>
			<tr>
				<td class="item">�[�i�� �X�֔ԍ�</td>
				<td>{%$app.orderheader.dest_post%}</td>
			<tr>
				<td class="item">�[�i�� �Z��1</td>
				<td>
{%foreach from=$app.kenList item=klist%}
{%if $klist.code == $app.orderheader.dest_pref_cd %}{%$klist.name%}{%/if%}
{%/foreach%}
{%$app.orderheader.dest_address1%}{%$app.orderheader.dest_address2%}
				</td>
			</tr>
			<tr>
				<td class="item">�[�i�� �Z��2</td>
				<td>{%$app.orderheader.dest_address3%}</td>
			</tr>
			<tr>
				<td class="item">�[�i�� �S����</td>
				<td>{%$app.orderheader.dest_contact_name1%}</td>
			</tr>
			<tr>
				<td class="item">�[�i��d�b�ԍ�</td>
				<td>{%$app.orderheader.dest_tel%}</td>
			</tr>
			<tr>
				<td class="item">�[�i��FAX�ԍ�</td>
				<td>{%$app.orderheader.dest_fax%}</td>
			<tr>
				<td class="item">�`�[�Y�t</td>
				<td>{%if $app.orderheader.direct_delivery_type == "1" %}��{%else%}�L{%/if%}</td>
			</tr>
			<tr>
				<td class="item">���l</td>
				<td>{%$app.orderheader.deliver_memo%}</td>
			</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td colspan="2">
		<br /><table width="700px" border="1" cellspacing="0">
			<tr>
				<td class="item">�M�Д���No.</td>
				<td class="item">���i�R�[�h</td>
				<td class="item">���i����</td>
				<td class="item">�񋟉��i</td>
				<td class="item">����</td>
				<td class="item">���z</td>
			</tr>
{%foreach from=$app.orderdetailList item=detaillist %}
			<tr>
				<td>{%$detaillist.cust_order_num%}&nbsp;</td>
				<td>{%$detaillist.item_cd%}</td>
				<td>{%$detaillist.item_name_kanji%}</td>
				<td align="right">\&nbsp;{%$detaillist.item_price|number_format%}</td>
				<td width="30px" align="right">{%$detaillist.item_vol|number_format%}</td>
				<td align="right">\&nbsp;{%$detaillist.item_amt|number_format%}</td>
			</tr>
{%/foreach%}
		</table>
		</td>
	</tr>
	<tr>
		<td align="right" colspan="2">
		<table border="1" cellspacing="0">
			<tr>
				<td class="item" width="65px">���v</td>
				<td align="right">\&nbsp;{%$app.orderheader.total_amt|number_format%}</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

<table border="0" width="95%">
	<tr>
		<td width="30%">&nbsp;</td>
		<td width="40%" align="center">
				<a href="javascript:printPreview();"><img src="../img/print.png" alt="���������" width="120px" height="50px"></a>
		</td>
		<td width="30%" align="right">
{%if $app.orderheader.delete_ok == 1%}
				<a href="javascript:delSubmit();"><img src="../img/delete.png" alt="�폜" width="120px" height="50px"></a>
{%else%}
				&nbsp;
{%/if%}
		</td>
	</tr>
</table>

{%* ���q�l��񂪓o�^����Ă���ꍇ�̂ݕ\�� *%}
{%if $app.orderheader.name1 != "" %}
<table border="0">
	<tr>
		<td>
			<br /><br /><table class="select" width="400px" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item" width="200px">�o�^���`</td>
					<td>{%$app.orderheader.name1%}{%$app.orderheader.name2%}</td>
				</tr>
				<tr>
					<td class="item">�o�^���`(�t���K�i)</td>
					<td>{%$app.orderheader.name_kana1%}</td>
				</tr>
				<tr>
					<td class="item">��\������܂��͑�\��</td>
					<td>{%$app.orderheader.president_name1%}</td>
				</tr>
				<tr>
					<td class="item">��\������܂��͑�\��(�t���K�i)</td>
					<td>{%$app.orderheader.president_name_kana1%}</td>
				</tr>
				<tr>
					<td class="item">�S����</td>
					<td>{%$app.orderheader.contact_name1%}</td>
				</tr>
				<tr>
					<td class="item">�S����(�t���K�i)</td>
					<td>{%$app.orderheader.contact_name_kana1%}</td>
				</tr>
				<tr>
{%if $app.orderheader.state_type == "4"%}
					<td class="item">���[���A�h���X�@�@<input type="button" value="�ύX" style="font-size:10px;" onClick="document.frmMailChg.submit();"></td>
{%else%}
					<td class="item">���[���A�h���X</td>
{%/if%}
					<td>{%$app.orderheader.mail_address%}</td>
				</tr>
				<tr>
					<td class="item">�z�[���y�[�WURL</td>
					<td>{%$app.orderheader.url%}</td>
				</tr>
				<tr>
					<td class="item">�X�֔ԍ�</td>
					<td>{%$app.orderheader.post%}</td>
				</tr>
				<tr>
					<td class="item">�s���{���s�撬��</td>
					<td>
{%foreach from=$app.kenList item=klist%}
{%if $klist.code == $app.orderheader.prefecture_cd %}{%$klist.name%}{%/if%}
{%/foreach%}
{%$app.orderheader.address1%}
					</td>
				</tr>
				<tr>
					<td class="item">���Ԓn</td>
					<td>{%$app.orderheader.address2%}</td>
				</tr>
				<tr>
					<td class="item">������</td>
					<td>{%$app.orderheader.address3%}</td>
				</tr>
				<tr>
					<td class="item">�o�^�d�b�ԍ�</td>
					<td>{%$app.orderheader.tel%}</td>
				</tr>
				<tr>
					<td class="item">�A����d�b�ԍ�</td>
					<td>{%$app.orderheader.communicate_tel%}</td>
				</tr>
				<tr>
					<td class="item">�A����FAX�ԍ�</td>
					<td>{%$app.orderheader.fax%}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{%/if%}

{%else%}
<table border="0">
	<tr>
		<td>
{%foreach from=$errors item=error%}
          <font color=red><li>{%$error%}</font></li>
{%/foreach%}
		</td>
	</tr>
</table>
{%/if%}


<br /><a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>

{%include file="weborder/common/footer.tpl"%}
</div>
</center>
</body>
</html>
