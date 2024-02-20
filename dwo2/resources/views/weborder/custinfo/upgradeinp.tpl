<html>
<head>
<title>ユーザー登録済み製品 or 通常製品</title>
<link rel="stylesheet"type="text/css"href="../css/common.css">

<script type="text/javascript">
<!--
	function zip_search() {
		if (document.frm.frm_regist_zip1.value == "") {
			alert("郵便番号を入力してください。");
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
		// 県名をセット
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
		<h4 class="select">▼お客様情報入力</h4>
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
		今回のご注文は、以下でご入力いただく情報をもとに、ユーザー登録を更新して<br />
		お届けいたします。<br />
		お客様のご登録情報は正確にご入力いただけますようお願いいたします。<br /><br />
		■<a href="?action_weborderCustinfoHandling=t" target="_blank">「個人情報保護方針」について</a>■<br />ご購入のお客様に「承認確認メール			」が送信されます。<br />
		「メールアドレス」をお間違えのないよう入力してください。<br /><br />
		■入力項目について■<br />
		<span id="essential">*</span>がついている項目はかならず入力してください。<br />
		<span id="essential">入力文字に半角特殊文字("'!#$%*+&;等)は使用しないで下さい。</span><br />
		入力項目で(半角)の指示があるところは、<span id="essential">必ず</span>半角で、それ以外は全角で入力して下さい。<br /><br />
		<td>
	<tr>

{%if count($errors) > 0 %}
	<tr>
		<td>
          <font color=red>■入力内容に誤りがあります。以下のエラーをご確認下さい。
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
					<td class="item" width="200px">登録名義<span id="gray">[32文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_name" value="{%$form.frm_regist_name%}" disabled></td>
				</tr>
				<tr>
					<td class="item">登録名義(カタカナ)<span id="gray">[40文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_kana" value="{%$form.frm_regist_kana%}" disabled></td>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者<span id="gray">[15文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="15" name="frm_regist_ceo" value="{%$form.frm_regist_ceo%}" disabled></td>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者(カタカナ)<br><span id="gray">[30文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="30" name="frm_regist_ceo_kana" value="{%$form.frm_regist_ceo_kana%}" disabled></td>
				</tr>
				<tr>
					<td class="item">担当者名<span id="gray">[8文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="8" name="frm_regist_name_of_charge" value="{%$form.frm_regist_name_of_charge%}"></td>
				</tr>
				<tr>
					<td class="item">担当者名(カタカナ)<span id="gray">[16文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="16" name="frm_regist_name_of_charge_kana" value="{%$form.frm_regist_name_of_charge_kana%}"></td>
				</tr>
{%if $form.chk_cust_kbn == "OR"%}
				<tr>
					<td class="item">メールアドレス<span id="gray">[半角]</span></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail" value="{%$form.frm_regist_mail%}" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item" valign="bottom">メールアドレス確認<span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail_chk" value="{%$form.frm_regist_mail_chk%}" style="ime-mode: disabled;"></td>
				</tr>
{%else%}
				<tr>
					<td class="item">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail" value="{%$form.frm_regist_mail%}" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item" valign="bottom">メールアドレス確認<span id="essential">*</span><span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail_chk" value="{%$form.frm_regist_mail_chk%}" style="ime-mode: disabled;"></td>
				</tr>
{%/if%}
				<tr>
					<td class="item">ホームページURL<span id="gray">[半角]</span></td>
					<td><input type="text" size="50" maxlength="100" name="frm_regist_url" value="{%$form.frm_regist_url%}" style="ime-mode: disabled;"><div id="gray">(例) http://www.yayoi-kk.co.jp/</div></td>
				</tr>
				<tr>
					<td class="item">郵便番号<span id="essential">*</span></td>
					<td>
						<input type="text" size="6" maxlength="3" name="frm_regist_zip1" value="{%$form.frm_regist_zip1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="7" maxlength="4" name="frm_regist_zip2" value="{%$form.frm_regist_zip2%}" style="ime-mode: disabled;">
						<input class="address" type="button" value="住所検索" onClick="zip_search();"><div id="gray">(例) 123 - 4567</div>
					</td>
				</tr>

				<tr>
					<td class="item">都道府県<span id="essential">*</span></td>
					<td>
						<SELECT name="frm_regist_pref_cd">
							<OPTION value="">選択して下さい
{%foreach from=$session.kenList item=klist%}
							<OPTION value={%$klist.code%} {%if $klist.code == $form.frm_regist_pref_cd %}SELECTED{%/if%}>{%$klist.name%}
{%/foreach%}
						</SELECT>
						<div id="gray">(例) 東京都</div>
					</td>
				</tr>

				<tr>
					<td class="item">市区町村<span id="essential">*</span><span id="gray">[16文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="16" name="frm_regist_add1" value="{%$form.frm_regist_add1%}"><div id="gray">(例) 千代田区外神田</div></td>
				</tr>
				<tr>
					<td class="item">丁番地<span id="essential">*</span><span id="gray">[20文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_add2" value="{%$form.frm_regist_add2%}"><div id="gray">(例) ４丁目１４番１号</div></td>
				</tr>
				<tr>
					<td class="item">建物名<span id="gray">[20文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_add3" value="{%$form.frm_regist_add3%}"><div id="gray">(例) 秋葉原ＵＤＸ２１階</div></td>
				</tr>
				<tr>
					<td class="item">登録電話番号<span id="gray">[半角]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_tel1" value="{%$form.frm_regist_tel1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_tel2" value="{%$form.frm_regist_tel2%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_tel3" value="{%$form.frm_regist_tel3%}" style="ime-mode: disabled;">
					</td>
				</tr>
					<td class="item">連絡先電話番号<span id="gray">[半角]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel1" value="{%$form.frm_regist_contact_tel1%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel2" value="{%$form.frm_regist_contact_tel2%}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel3" value="{%$form.frm_regist_contact_tel3%}" style="ime-mode: disabled;">
					</td>
				</tr>
					<td class="item">連絡先FAX番号<span id="gray">[半角]</span></td>
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
			<a href="javascript:history.back();"><img src="../img/back.png" alt="戻る" width="120px" height="50px"></a>
			<a href="javascript:regCustSubmit();"><img src="img/next.png" alt="次へ" width="120px" height="50px"></a>
		</td>
	</tr>
</table>
</form>

{%include file="weborder/common/footer.tpl"%}

</div>
</center>
</body>
</html>

