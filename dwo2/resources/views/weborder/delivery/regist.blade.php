<x-app-layout>

<title>新規納品先</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('delivery') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}


<script type="text/javascript">
<!--
	function zip_search() {
		if (document.frm.reg_delivery_zip1.value == "") {
			alert("郵便番号を入力してください。");
			document.frm.reg_delivery_zip1.focus();
			return;
		}
		document.frmZip.frm_zip1.value = document.frm.reg_delivery_zip1.value;
		document.frmZip.frm_zip2.value = document.frm.reg_delivery_zip2.value;
		w = window.open("", "ZipWin", "width=640,height=480,scrollbars=yes");
		if (w) {
			document.frmZip.submit();
		}
	}

	function setZip(p_zip,p_pref,p_city) {
		document.frm.reg_delivery_zip1.value = p_zip.substr(0, 3);
		document.frm.reg_delivery_zip2.value = p_zip.substr(3);
		document.frm.reg_delivery_add1.value = p_city;

		if (document.frm.reg_delivery_pref_cd) {
			for (i = 0; i < document.frm.reg_delivery_pref_cd.options.length; i++) {
				if (document.frm.reg_delivery_pref_cd.options[i].text == p_pref) {
					document.frm.reg_delivery_pref_cd.options[i].selected = true;
					break;
				}
			}
		}
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

<br /><table align="center" width="100%">
	<tr>
		<td>
		<h4>▼新規納品先</h4>
		</td>
	</tr>
</table>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach
<br>
{{ html()->form('POST', '/zip/searchzip')->attributes(['name' => 'frmZip', 'target' => 'ZipWin'])->style('margin:0px;')->open() }}
{{ html()->hidden('frm_zip1') }}
{{ html()->hidden('frm_zip2') }}
{{ html()->form()->close() }}

{{ html()->form('POST', '/delivery/other/store')->attribute('name', 'frm')->open() }}

<table border="0" align="center">
	<tr>
		<td>
			<p class="address">
				■納品先住所について■<br />
				<span id="essential">納品先住所（都道府県/市区町村）は都道府県から正確に入力をお願い致します。</span><br /><br />
				■入力項目について■<br />
				<span id="essential">*</span>がついている項目はかならず入力してください。<br />
				<span id="essential">入力文字に半角特殊文字("'!#$%*+&;等)は使用しないで下さい。</span><br />
				入力項目で(半角)の指示があるところは、<span id="essential">必ず</span>半角で、それ以外は全角で入力して下さい。<br />
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<table class="new" border="1"cellspacing="0"frame="hsides"rules="rows">
				<tr>
					<td class="item"width="230px">納品先名称<span id="essential">*</span><span id="gray">[32文字/全角]</span></td>
					<td width="300px">
						{{ html()->text('reg_delivery_name', $reg_delivery_name)->attributes(['size' => '50', 'maxlength' => '32']) }}
					</td>
				</tr>
				<tr>
					<td class="item">納品先担当者<span id="gray">[7文字/全角]</span></td>
					<td>
						{{ html()->text('reg_delivery_name_of_charge', $reg_delivery_name_of_charge)->attribute('maxlength', '7') }}様
					</td>
				</tr>
				<tr>
					<td class="item">納品先郵便番号<span id="essential">*</span><span id="gray">[半角]</span></td>
					<td>
						{{ html()->text('reg_delivery_zip1', $reg_delivery_zip1)->attributes(['size' => '6', 'maxlength' => '3']) }}
						&nbsp;-&nbsp;
						{{ html()->text('reg_delivery_zip2', $reg_delivery_zip2)->attributes(['size' => '7', 'maxlength' => '4']) }}
						{{ html()->button('住所検索')->class('address')->attribute('onClick', 'zip_search(); return false;') }}
						<div id="gray">(例) 123 - 4567</div>
					</td>
				</tr>


				<tr>
					<td class="item">納品先住所(都道府県)<span id="essential">*</span></td>
					<td>
						<SELECT name="reg_delivery_pref_cd">
							{{ html()->option('選択して下さい') }}
							@foreach ($prefList as $pref)
								{{ html()->option($pref->pref_name, $pref->pref_cd ,($pref->pref_cd == old('reg_delivery_pref_cd'))) }}
							@endforeach
						</SELECT>
						<div id="gray">(例) 東京都</div></td>
					</td>
				</tr>

				<tr>
					<td class="item">納品先住所(市区町村)<span id="essential">*</span><span id="gray">[16文字/全角]</span></td>
					<td>
						{{ html()->text('reg_delivery_add1', $reg_delivery_add1)->attributes(['size' => '50', 'maxlength' => '16']) }}
						<div id="gray">(例) 千代田区外神田</div>
					</td>
				</tr>


				<tr>
					<td class="item">納品先住所(番地)<span id="essential">*</span><span id="gray">[20文字/全角]</span></td>
					<td>
						{{ html()->text('reg_delivery_add2', $reg_delivery_add2)->attributes(['size' => '50', 'maxlength' => '20']) }}
						<div id="gray">(例) ４丁目１４番１号</div>
					</td>
				</tr>
				<tr>
					<td class="item">納品先住所(マンション・ビル)<span id="gray">[20文字/全角]</span></td>
					<td>
						{{ html()->text('reg_delivery_add3', $reg_delivery_add3)->attributes(['size' => '50', 'maxlength' => '20']) }}
						<div id="gray">(例) 秋葉原ＵＤＸ２１階</div>
					</td>
				</tr>
				<tr>
					<td class="item">納品先電話番号<span id="essential">*</span><span id="gray">[半角]</span></td>
					<td>
						{{ html()->text('reg_delivery_tel1', $reg_delivery_tel1)->attributes(['size' => '4', 'maxlength' => '4']) }}
						&nbsp;-&nbsp;
						{{ html()->text('reg_delivery_tel2', $reg_delivery_tel2)->attributes(['size' => '4', 'maxlength' => '4']) }}
						&nbsp;-&nbsp;
						{{ html()->text('reg_delivery_tel3', $reg_delivery_tel3)->attributes(['size' => '4', 'maxlength' => '4']) }}
						<div id="gray">(例) 03 - 1234 - 5678</div>
					</td>
				</tr>
				<tr>
					<td class="item">納品先FAX番号&nbsp;<span id="gray">[半角]</span></td>
					<td>
						{{ html()->text('reg_delivery_fax1', $reg_delivery_fax1)->attributes(['size' => '4', 'maxlength' => '4']) }}
						&nbsp;-&nbsp;
						{{ html()->text('reg_delivery_fax2', $reg_delivery_fax2)->attributes(['size' => '4', 'maxlength' => '4']) }}
						&nbsp;-&nbsp;
						{{ html()->text('reg_delivery_fax3', $reg_delivery_fax3)->attributes(['size' => '4', 'maxlength' => '4']) }}
						<div id="gray">(例) 03 - 1234 - 5678</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<div id="next">
				<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
				<a href="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/registration.png') }}" alt="登録" width="120px" height="50px"></a>
			</div>
		</td>
	</tr>
</table>
{{ html()->form()->close() }}

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
