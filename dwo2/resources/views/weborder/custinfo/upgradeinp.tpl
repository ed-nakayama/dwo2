<html>
<head>
<title>���[�U�[�o�^�ςݐ��i or �ʏ퐻�i</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">

<script type="text/javascript">
<!--
	function zip_search() {
		if (document.frm.frm_regist_zip1.value == "") {
			alert("�X�֔ԍ�����͂��Ă��������B");
			document.frm.frm_regist_zip1.focus();
			return;
		}
		document.frmZip.frm_zip1.value = document.frm.frm_regist_zip1.value;
		document.frmZip.frm_zip2.value = document.frm.frm_regist_zip2.value;
		w = window.open("", "ZipWin", "width=640,height=480,scrollbars=yes");
		if (w) {
			document.frmZip.submit();
		}
	}

	function setZip(p_zip,p_pref,p_city) {
		document.frm.frm_regist_zip1.value = p_zip.substr(0, 3);
		document.frm.frm_regist_zip2.value = p_zip.substr(3);
		document.frm.frm_regist_add1.value = p_city;

		if (document.frm.frm_regist_pref_cd) {
			for (i = 0; i < document.frm.frm_regist_pref_cd.options.length; i++) {
				if (document.frm.frm_regist_pref_cd.options[i].text == p_pref) {
					document.frm.frm_regist_pref_cd.options[i].selected = true;
					break;
				}
			}
		}
	}

	function regCustSubmit() {
		n = document.frm.frm_regist_pref_cd.selectedIndex;
		// �������Z�b�g
		document.frm.frm_regist_pref.value = document.frm.frm_regist_pref_cd.options[n].text;
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

<br /><table width="700px">
	<tr>
		<td>
		<h4 class="select">�����q�l������</h4>
		</td>
	</tr>
</table>

<form name="frmDelivery" style="margin:0px;">
	<input type="hidden" name="delivery_name"           value="{%$app.forCpOrderinfo.delivery_name%}"          >
	<input type="hidden" name="delivery_zip"            value="{%$app.forCpOrderinfo.delivery_zip%}"           >
	<input type="hidden" name="delivery_pref_cd"        value="{%$app.forCpOrderinfo.delivery_pref_cd%}"       >
	<input type="hidden" name="delivery_add1"           value="{%$app.forCpOrderinfo.delivery_add1%}"          >
	<input type="hidden" name="delivery_add2"           value="{%$app.forCpOrderinfo.delivery_add2%}"          >
	<input type="hidden" name="delivery_add3"           value="{%$app.forCpOrderinfo.delivery_add3%}"          >
	<input type="hidden" name="delivery_name_of_charge" value="{%$app.forCpOrderinfo.delivery_name_of_charge%}">
	<input type="hidden" name="delivery_tel1"           value="{%$app.forCpOrderinfo.delivery_tel1%}"          >
	<input type="hidden" name="delivery_tel2"           value="{%$app.forCpOrderinfo.delivery_tel2%}"          >
	<input type="hidden" name="delivery_tel3"           value="{%$app.forCpOrderinfo.delivery_tel3%}"          >
	<input type="hidden" name="delivery_fax1"           value="{%$app.forCpOrderinfo.delivery_fax1%}"          >
	<input type="hidden" name="delivery_fax2"           value="{%$app.forCpOrderinfo.delivery_fax2%}"          >
	<input type="hidden" name="delivery_fax3"           value="{%$app.forCpOrderinfo.delivery_fax3%}"          >
</form>


<form name="frmZip" action="{%$script%}" method="post" style="margin:0px;" target="ZipWin">
	<input type="hidden" name="action_weborderZipSearchzip" value="true">
	<input type="hidden" name="frm_zip1" value="">
	<input type="hidden" name="frm_zip2" value="">
</form>

<form name="frm" action="{%$script%}" method="post" style="margin:0px;">

	<input type="hidden" name="action_weborderCustinfoUpgradeinpDo" value="true">
<!--	
	<input type="hidden" name="action_weborderOrderUpgradeprint" value="true">
-->	
	<input type="hidden" name="frm_regist_pref" value="">

<table border="0">
	<tr>
		<td>
		����̂������́A�ȉ��ł����͂��������������ƂɁA���[�U�[�o�^���X�V����<br />
		���͂��������܂��B<br />
		���q�l�̂��o�^���͐��m�ɂ����͂��������܂��悤���肢�������܂��B<br /><br />
		��<a href="?action_weborderCustinfoHandling=t" target="_blank">�u�l���ی���j�v�ɂ���</a>��<br />���w���̂��q�l�Ɂu���F�m�F���[��			�v�����M����܂��B<br />
		�u���[���A�h���X�v�����ԈႦ�̂Ȃ��悤���͂��Ă��������B<br /><br />
		�����͍��ڂɂ��ā�<br />
		<span id="essential">*</span>�����Ă��鍀�ڂ͂��Ȃ炸���͂��Ă��������B<br />
		<span id="essential">���͕����ɔ��p���ꕶ��("'!#$%*+&;��)�͎g�p���Ȃ��ŉ������B</span><br />
		���͍��ڂ�(���p)�̎w��������Ƃ���́A<span id="essential">�K��</span>���p�ŁA����ȊO�͑S�p�œ��͂��ĉ������B<br /><br />
		<td>
	<tr>

{%if count($errors) > 0 %}
	<tr>
		<td>
          <font color=red>�����͓��e�Ɍ�肪����܂��B�ȉ��̃G���[�����m�F�������B
{%foreach from=$errors item=error%}
          <font color=red><li>{%$error%}</font></li>
{%/foreach%}
		</td>
	<tr>
{%/if%}

	<tr>
		<td>
			<table class="new" width="500px" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item" width="200px">�o�^���`<span id="gray">[32����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_name" value="{%$form.frm_regist_name%}" disabled></td>
				</tr>
				<tr>
					<td class="item">�o�^���`(�J�^�J�i)<span id="gray">[40����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_kana" value="{%$form.frm_regist_kana%}" disabled></td>
				</tr>
				<tr>
					<td class="item">��\�Ҏ�����܂��͑�\��<span id="gray">[15����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="15" name="frm_regist_ceo" value="{%$form.frm_regist_ceo%}" disabled></td>
				</tr>
				<tr>
					<td class="item">��\�Ҏ�����܂��͑�\��(�J�^�J�i)<br><span id="gray">[30����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="30" name="frm_regist_ceo_kana" value="{%$form.frm_regist_ceo_kana%}" disabled></td>
				</tr>
				<tr>
					<td class="item">�S���Җ�<span id="gray">[8����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="8" name="frm_regist_name_of_charge" value="{%$form.frm_regist_name_of_charge%}"></td>
				</tr>
				<tr>
					<td class="item">�S���Җ�(�J�^�J�i)<span id="gray">[16����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="16" name="frm_regist_name_of_charge_kana" value="{%$form.frm_regist_name_of_charge_kana%}"></td>
				</tr>
{%if $form.chk_cust_kbn == "OR"%}
				<tr>
					<td class="item">���[���A�h���X<span id="gray">[���p]</span></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail" value="{%$form.frm_regist_mail%}" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item" valign="bottom">���[���A�h���X�m�F<span id="gray">[���p]</span><br /><div id="essential">���m�F�ׁ̈A������x���͂��ĉ�����</div></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail_chk" value="{%$form.frm_regist_mail_chk%}" style="ime-mode: disabled;"></td>
				</tr>
{%else%}
				<tr>
					<td class="item">���[���A�h���X<span id="essential">*</span><span id="gray">[���p]</span></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail" value="{%$form.frm_regist_mail%}" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item" valign="bottom">���[���A�h���X�m�F<span id="essential">*</span><span id="gray">[���p]</span><br /><div id="essential">���m�F�ׁ̈A������x���͂��ĉ�����</div></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail_chk" value="{%$form.frm_regist_mail_chk%}" style="ime-mode: disabled;"></td>
				</tr>
{%/if%}
				<tr>
					<td class="item">�z�[���y�[�WURL<span id="gray">[���p]</span></td>
					<td><input type="text" size="50" maxlength="100" name="frm_regist_url" value="{%$form.frm_regist_url%}" style="ime-mode: disabled;"><div id="gray">(��) http://www.yayoi-kk.co.jp/</div></td>
				</tr>
				<tr>
					<td class="item">�X�֔ԍ�<span id="essential">*</span></td>
					<td>
						<input type="text" size="6" maxlength="3" name="frm_regist_zip1" value="{%$form.frm_regist_zip1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="7" maxlength="4" name="frm_regist_zip2" value="{%$form.frm_regist_zip2%}" style="ime-mode: disabled;">
						<input class="address" type="button" value="�Z������" onClick="zip_search();"><div id="gray">(��) 123 - 4567</div>
					</td>
				</tr>

				<tr>
					<td class="item">�s���{��<span id="essential">*</span></td>
					<td>
						<SELECT name="frm_regist_pref_cd">
							<OPTION value="">�I�����ĉ�����
{%foreach from=$session.kenList item=klist%}
							<OPTION value={%$klist.code%} {%if $klist.code == $form.frm_regist_pref_cd %}SELECTED{%/if%}>{%$klist.name%}
{%/foreach%}
						</SELECT>
						<div id="gray">(��) �����s</div>
					</td>
				</tr>

				<tr>
					<td class="item">�s�撬��<span id="essential">*</span><span id="gray">[16����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="16" name="frm_regist_add1" value="{%$form.frm_regist_add1%}"><div id="gray">(��) ���c��O�_�c</div></td>
				</tr>
				<tr>
					<td class="item">���Ԓn<span id="essential">*</span><span id="gray">[20����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_add2" value="{%$form.frm_regist_add2%}"><div id="gray">(��) �S���ڂP�S�ԂP��</div></td>
				</tr>
				<tr>
					<td class="item">������<span id="gray">[20����/�S�p]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_add3" value="{%$form.frm_regist_add3%}"><div id="gray">(��) �H�t���t�c�w�Q�P�K</div></td>
				</tr>
				<tr>
					<td class="item">�o�^�d�b�ԍ�<span id="gray">[���p]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_tel1" value="{%$form.frm_regist_tel1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_tel2" value="{%$form.frm_regist_tel2%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_tel3" value="{%$form.frm_regist_tel3%}" style="ime-mode: disabled;">
					</td>
				</tr>
					<td class="item">�A����d�b�ԍ�<span id="gray">[���p]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel1" value="{%$form.frm_regist_contact_tel1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel2" value="{%$form.frm_regist_contact_tel2%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel3" value="{%$form.frm_regist_contact_tel3%}" style="ime-mode: disabled;">
					</td>
				</tr>
					<td class="item">�A����FAX�ԍ�<span id="gray">[���p]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_fax1" value="{%$form.frm_regist_contact_fax1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_fax2" value="{%$form.frm_regist_contact_fax2%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_fax3" value="{%$form.frm_regist_contact_fax3%}" style="ime-mode: disabled;">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><div id="next">
			<a href="javascript:history.back();"><img src="../img/back.png" alt="�߂�" width="120px" height="50px"></a>
			<a href="javascript:regCustSubmit();"><img src="img/next.png" alt="����" width="120px" height="50px"></a>
		</td>
	</tr>
</table>
</form>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

