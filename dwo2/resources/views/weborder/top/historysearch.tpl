<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=shift_jis">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>web�I�[�_�[����</title>

<script type="text/javascript">
<!--
	function dtlSearch(o_num) {
		document.frmDtl.frm_order_num.value = o_num;
		document.frmDtl.submit();
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

<br /><table width="550px">
	<tr>
		<td>
		<h4>�������m�F</h4>
		</td>
	</tr>
</table>

<form name="frmDtl" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorydetail" value="true">
	<input type="hidden" name="frm_order_num" value="">
</form>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">
	<input type="hidden" name="action_weborderTopHistorysearch" value="true">

<table border="0" width="500px">
	<tr>
		<td height="130px">
���X�e�[�^�X�ɂ��ā�<br />
�X�e�[�^�X�Ƃ́A���݂̏����󋵂ɂ��Đ������Ă���܂��B<br />
<br />
�E���F�҂� �i�u���w���̂��q�l�v�̂����F�҂��j�@�@&lt;�������̍폜���\�ł�&gt;<br />
�E��t�� �i��������A���Љc�Ɠ���15���܂ł̃X�e�[�^�X�j�@&lt;�������̍폜���\�ł�&gt;<br />
		</td>
	</tr>
	<tr>
		<td class="search">
		����������
		</td>
	</tr>

{%if count($errors) > 0%}
	<tr>
		<td>
{%foreach from=$errors item=error%}
          <font color=red><li>{%$error%}</font></li>
{%/foreach%}
		</td>
	</tr>
{%/if%}

	<tr>
		<td align="center" height="200px">
			<br /><table class="new" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">��tNo.</td>
					<td>
						<input type="text" name="frm_web_order_num" value="{%$form.frm_web_order_num%}" maxlength="10" style="ime-mode: disabled;">
					</td>
				</tr>
				<tr>
					<td class="item">�[�i��`��</td>
					<td>
					&nbsp;<select name="frm_direct_delivery_type">
						<option class="gray" value="">�I�����ĉ�����</option>
						<option value="0" {%if $form.frm_direct_delivery_type == "0"%}selected{%/if%}>�M��</option>
						<option value="1" {%if $form.frm_direct_delivery_type == "1"%}selected{%/if%}>�ʓr�[�i��</option>
					</td>
				</tr>
				<tr>
					<td class="item">�ʓr�[�i�於��</td>
					<td>
						<input type="text" size="50" name="frm_dest_name1" value="{%$form.frm_dest_name1%}" maxlength="50">
					</td>
				</tr>
				<tr>
					<td class="item">�M�ВS����</td>
					<td>
						<input type="text" name="frm_dwo_order_person_name" value="{%$form.frm_dwo_order_person_name%}" maxlength="100">
					</td>
				</tr>
				<tr>
					<td class="item">���i�R�[�h</td>
					<td><input type="text" name="frm_item_cd" value="{%$form.frm_item_cd%}" maxlength="15" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item">
					�X�e�[�^�X
					</td>
					<td>
					&nbsp;<select name="frm_state_type">
						<option class="gray" value="">�I�����ĉ�����</option>

{%foreach from=$app.stList item=stlist %}
						<option value="{%$stlist.id%}" {%if $form.frm_state_type == $stlist.id%}selected{%/if%}>{%$stlist.nm%}</option>
{%/foreach %}
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><a href="javascript:document.frm.submit();"><img src="../img/search.png" alt="����" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

</form>

<table border="0" cellspacing="0">
	<tr>
		<td colspan="2" height="100px">
		<span id="essential">��</span>
		�[�i��̌����́A�[�i��`�ԂŋM�Ђ��M�ЈȊO(�ʓr�[�i��)�ɕ����čs���ĉ������B<br />
		�Ȃ��A�ʓr�[�i����w�肵���ꍇ�́A�[�i�於�̂̂����܂��������\�ł��B<br />
		</td>
	</tr>
	<tr>
		<td class="search">
		����������
		</td>
		<td class="search" align="right">
		�Y����&nbsp;{%$app.orderListCount%}
		</td>
	</tr>
	<tr>
		<td colspan="2" height="100px">
{%if $app.orderListCount <= 0%}
�����f�[�^��������܂���ł����B
{%else%}
			<table border="1" cellspacing="0">
				<tr>
					<td class="item">��tNo.</td>
					<td class="item">��t��</td>
					<td class="item" width="150px">�[�i�於��</td>
					<td class="item">�M�ВS����</td>
					<td class="item">�X�e�[�^�X</td>
					<td class="item" align="center">�ڍ�</td>
				</tr>
{%foreach from=$app.orderList item=orderlist %}
				<tr>
					<td>{%$orderlist.web_order_num%}</td>
					<td>{%$orderlist.dwo_last_update%}</td>
					<td align="center">{%$orderlist.dest_name1%}{%$orderlist.dest_name2%}</td>
					<td>{%$orderlist.dwo_order_person_name%}&nbsp;</td>
					<td align="center">{%$orderlist.state_type_str%}</td>
					<td>
						<input type="button" value="�ڍ�" onClick="dtlSearch('{%$orderlist.web_order_num%}');">
					</td>
				</tr>
{%/foreach%}
			</table>
{%/if%}
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<a href="?action_weborderTopHome=t"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
		</td>
	</tr>
</table>



{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>
