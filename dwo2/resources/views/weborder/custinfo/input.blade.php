<x-app-layout>

<title>ユーザー登録済み製品 or 通常製品</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('custinfo') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}


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

	function copyDelivery() {
		document.frm.frm_regist_name.value = document.frmDelivery.delivery_name.value;
		tmpzip = document.frmDelivery.delivery_zip.value;
		if (tmpzip.length > 3) {
			document.frm.frm_regist_zip1.value = tmpzip.substr(0,3);
			document.frm.frm_regist_zip2.value = tmpzip.substr(3);
		} else {
			document.frm.frm_regist_zip1.value = tmpzip;
		}
		document.frm.frm_regist_pref_cd.value = document.frmDelivery.delivery_pref_cd.value;
		document.frm.frm_regist_add1.value = document.frmDelivery.delivery_add1.value;
		document.frm.frm_regist_add2.value = document.frmDelivery.delivery_add2.value;
		document.frm.frm_regist_add3.value = document.frmDelivery.delivery_add3.value;
		document.frm.frm_regist_name_of_charge.value = document.frmDelivery.delivery_name_of_charge.value;
		document.frm.frm_regist_tel1.value = document.frmDelivery.delivery_tel1.value;
		document.frm.frm_regist_tel2.value = document.frmDelivery.delivery_tel2.value;
		document.frm.frm_regist_tel3.value = document.frmDelivery.delivery_tel3.value;
		document.frm.frm_regist_contact_fax1.value = document.frmDelivery.delivery_fax1.value;
		document.frm.frm_regist_contact_fax2.value = document.frmDelivery.delivery_fax2.value;
		document.frm.frm_regist_contact_fax3.value = document.frmDelivery.delivery_fax3.value;
	}
-->
</script>


<div id="menu_userinfo">
<table border="0">
	<tr>
		<td class="userinfo" rowspan="3" valign="top">
			@include ('weborder/common/userinfo')
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
	<input type="hidden" name="delivery_name"           value="{{ $orderinfo->delivery_name }}"          >
	<input type="hidden" name="delivery_zip"            value="{{ $orderinfo->delivery_zip }}"           >
	<input type="hidden" name="delivery_pref_cd"        value="{{ $orderinfo->delivery_pref_cd }}"       >
	<input type="hidden" name="delivery_add1"           value="{{ $orderinfo->delivery_add1 }}"          >
	<input type="hidden" name="delivery_add2"           value="{{ $orderinfo->delivery_add2 }}"          >
	<input type="hidden" name="delivery_add3"           value="{{ $orderinfo->delivery_add3 }}"          >
	<input type="hidden" name="delivery_name_of_charge" value="{{ $orderinfo->delivery_name_of_charge }}">
	<input type="hidden" name="delivery_tel1"           value="{{ $orderinfo->delivery_tel1 }}"          >
	<input type="hidden" name="delivery_tel2"           value="{{ $orderinfo->delivery_tel2 }}"          >
	<input type="hidden" name="delivery_tel3"           value="{{ $orderinfo->delivery_tel3 }}"          >
	<input type="hidden" name="delivery_fax1"           value="{{ $orderinfo->delivery_fax1 }}"          >
	<input type="hidden" name="delivery_fax2"           value="{{ $orderinfo->delivery_fax2 }}"          >
	<input type="hidden" name="delivery_fax3"           value="{{ $orderinfo->delivery_fax3 }}"          >
{{ html()->form()->close() }}


{{ html()->form('POST', '/zip/searchzip')->attributes(['name' => 'frmZip', 'target' => 'ZipWin'])->open() }}
	<input type="hidden" name="frm_zip1" value="">
	<input type="hidden" name="frm_zip2" value="">
{{ html()->form()->close() }}

{{ html()->form('POST', '/custinfo/input')->attribute('name', 'frm')->open() }}
	<input type="hidden" name="frm_regist_pref" value="">

<table border="0">
	<tr>
		<td>
		今回のご購入製品はこの情報をもとに、ユーザ登録を済ませてお届けいたします。<br />
		あらかじめお客様のご登録情報を正確にご記入いただけますようお願いいたします。<br /><br />
		■<a href="/custinfo/handling" target="_blank">「個人情報保護方針」について</a>■<br />ご購入のお客様に「承認確認メール」が送信されます。<br />
		「メールアドレス」をお間違えのないよう入力してください。<br /><br />
		■入力項目について■<br />
		<span id="essential">*</span>がついている項目はかならず入力してください。<br />
		<span id="essential">入力文字に半角特殊文字("'!#$%*+&;等)は使用しないで下さい。</span><br />
		入力項目で(半角)の指示があるところは、<span id="essential">必ず</span>半角で、それ以外は全角で入力して下さい。<br /><br />
		<td>
	<tr>


@if (!empty($errors->all()) )
	<tr>
		<td>
			<font color=red>■入力内容に誤りがあります。以下のエラーをご確認下さい。
			@foreach ($errors->all() as $error)
				<font color=red><li>{{ $error }}</font></li>
			@endforeach
		</td>
	<tr>
@endif

	<tr>
		<td>
			<table width="500px" border="0" cellspacing="0" cellspacing="0">
				<tr>
					<td colspan="2" align="right"><input type="button" value="　納品先をコピー　" onClick="copyDelivery()"></td>
				</tr>
			</table>

			<table class="new" width="500px" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item" width="200px">登録名義<span id="essential">*</span><span id="gray">[32文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="32" name="frm_regist_name" value="{{ old('frm_regist_name' ,$orderinfo->regist_name) }}"></td>
				</tr>
				<tr>
					<td class="item">登録名義(カタカナ)<span id="essential">*</span><span id="gray">[40文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="40" name="frm_regist_kana" value="{{ old('frm_regist_kana' ,$orderinfo->regist_kana) }}"></td>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者<span id="gray">[15文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="15" name="frm_regist_ceo" value="{{ old('frm_regist_ceo' ,$orderinfo->regist_ceo) }}"></td>
				</tr>
				<tr>
					<td class="item">代表者取締役または代表者(カタカナ)<br><span id="gray">[30文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="30" name="frm_regist_ceo_kana" value="{{ old('frm_regist_ceo_kana' ,$orderinfo->regist_ceo_kana) }}"></td>
				</tr>
				<tr>
					<td class="item">担当者名<span id="gray">[8文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="8" name="frm_regist_name_of_charge" value="{{ old('frm_regist_name_of_charge' ,$orderinfo->regist_name_of_charge) }}"></td>
				</tr>
				<tr>
					<td class="item">担当者名(カタカナ)<span id="gray">[16文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="16" name="frm_regist_name_of_charge_kana" value="{{ old('frm_regist_name_of_charge_kana' ,$orderinfo->regist_name_of_charge_kana) }}"></td>
				</tr>
@if ($orderinfo->cust_kbn == "OR")
				<tr>
					<td class="item">メールアドレス<span id="gray">[半角]</span></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail" value="{{ old('frm_regist_mail' ,$orderinfo->regist_mail) }}" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item" valign="bottom">メールアドレス確認<span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail_confirmation" value="{{ old('frm_regist_mail_confirmation' ,$orderinfo->regist_mail) }}" style="ime-mode: disabled;"></td>
				</tr>
@else
				<tr>
					<td class="item">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail" value="{{ old('frm_regist_mail' ,$orderinfo->regist_mail) }}" style="ime-mode: disabled;"></td>
				</tr>
				<tr>
					<td class="item" valign="bottom">メールアドレス確認<span id="essential">*</span><span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
					<td><input type="text" size="50" maxlength="80" name="frm_regist_mail_confirmation" value="{{ old('frm_regist_mail_confirmation' ,$orderinfo->regist_mail) }}" style="ime-mode: disabled;"></td>
				</tr>
@endif
				<tr>
					<td class="item">ホームページURL<span id="gray">[半角]</span></td>
					<td><input type="text" size="50" maxlength="100" name="frm_regist_url" value="{{ old('frm_regist_url' ,$orderinfo->regist_url) }}" style="ime-mode: disabled;"><div id="gray">(例) http://www.yayoi-kk.co.jp/</div></td>
				</tr>
				<tr>
					<td class="item">郵便番号<span id="essential">*</span></td>
					<td>
						<input type="text" size="6" maxlength="3" name="frm_regist_zip1" value="{{ old('frm_regist_zip1' ,$orderinfo->regist_zip1) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="7" maxlength="4" name="frm_regist_zip2" value="{{ old('frm_regist_zip2' ,$orderinfo->regist_zip2) }}" style="ime-mode: disabled;">
						<input class="address" type="button" value="住所検索" onClick="zip_search();"><div id="gray">(例) 123 - 4567</div>
					</td>
				</tr>

				<tr>
					<td class="item">都道府県<span id="essential">*</span></td>
					<td>
						<SELECT name="frm_regist_pref_cd">
							<OPTION value="">選択して下さい
						@foreach ($prefList as $klist)
							<OPTION value={{ $klist->pref_cd }} @if ($klist->pref_cd == old('frm_regist_pref_cd' , $orderinfo->regist_pref_cd)) SELECTED @endif>{{ $klist->pref_name }}
						@endforeach
						</SELECT>
						<div id="gray">(例) 東京都</div>
					</td>
				</tr>

				<tr>
					<td class="item">市区町村<span id="essential">*</span><span id="gray">[16文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="16" name="frm_regist_add1" value="{{ old('frm_regist_add1' ,$orderinfo->regist_add1) }}"><div id="gray">(例) 千代田区外神田</div></td>
				</tr>
				<tr>
					<td class="item">丁番地<span id="essential">*</span><span id="gray">[20文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_add2" value="{{ old('frm_regist_add2' ,$orderinfo->regist_add2) }}"><div id="gray">(例) ４丁目１４番１号</div></td>
				</tr>
				<tr>
					<td class="item">建物名<span id="gray">[20文字/全角]</span></td>
					<td><input type="text" size="50" maxlength="20" name="frm_regist_add3" value="{{ old('frm_regist_add3' ,$orderinfo->regist_add3) }}"><div id="gray">(例) 秋葉原ＵＤＸ２１階</div></td>
				</tr>
				<tr>
					<td class="item">登録電話番号<span id="essential">*</span><span id="gray">[半角]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_tel1" value="{{ old('frm_regist_tel1' ,$orderinfo->regist_tel1) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_tel2" value="{{ old('frm_regist_tel2' ,$orderinfo->regist_tel2) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_tel3" value="{{ old('frm_regist_tel3' ,$orderinfo->regist_tel3) }}" style="ime-mode: disabled;"><div id="gray">(例) 03 - 1234 - 5678</div></td>
				</tr>
					<td class="item">連絡先電話番号<span id="gray">[半角]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel1" value="{{ old('frm_regist_contact_tel1' ,$orderinfo->regist_contact_tel1) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel2" value="{{ old('frm_regist_contact_tel2' ,$orderinfo->regist_contact_tel2) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_tel3" value="{{ old('frm_regist_contact_tel3' ,$orderinfo->regist_contact_tel3) }}" style="ime-mode: disabled;">
					</td>
				</tr>
					<td class="item">連絡先FAX番号<span id="gray">[半角]</span></td>
					<td>
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_fax1" value="{{ old('frm_regist_contact_fax1' ,$orderinfo->regist_contact_fax1) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_fax2" value="{{ old('frm_regist_contact_fax2' ,$orderinfo->regist_contact_fax2) }}" style="ime-mode: disabled;">&nbsp;-&nbsp;
						<input type="text" size="4" maxlength="4" name="frm_regist_contact_fax3" value="{{ old('frm_regist_contact_fax3' ,$orderinfo->regist_contact_fax3) }}" style="ime-mode: disabled;">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><div id="next">
			<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
			<a href="javascript:regCustSubmit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>
		</td>
	</tr>
</table>
{{ html()->form()->close() }}

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
