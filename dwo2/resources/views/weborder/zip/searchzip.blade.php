<x-guest-layout>

<title>ユーザー登録済み製品 or 通常製品</title>

{{---------------------------------------------------------------------------------------}}


<script type="text/javascript">
<!--
	function setParent(p_zip,p_pref,p_city) {
		window.opener.setZip(p_zip,p_pref,p_city);
		window.close();
	}
-->
</script>


<h5>郵便番号検索</h5>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td>
			<p class="sidebar">検索条件</p>
		</td>
	<tr>
</table>

{{ html()->form('POST', '/zip/searchzip')->attribute('name', 'frm')->open() }}

<table border=1 cellpadding=2 cellspacing=0>
	<tr>
		<td class="item">郵便番号</td>
		<td class="item">検索</td>
	</tr>
	<tr>
		<td>
			{{ html()->text('frm_zip1', $frm_zip1)->attributes(['size' => '5', 'maxlength' => '3']) }}
			&nbsp;-
			{{ html()->text('frm_zip2', $frm_zip2)->attributes(['size' => '7', 'maxlength' => '4']) }}
			&nbsp;［3桁-4桁］
		</td>
		<td>
			{{ html()->submit('検索') }}
		</td>
	</tr>
</table>

{{ html()->form()->close() }}

<br>

<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td>
			<p class="sidebar">検索結果</p>
		</td>
	<tr>
</table>

@if (!empty($ziplist[0]))
	<table border=1 cellpadding=2 cellspacing=0 width="90%">
		<tr>
			<td class="item">郵便番号</td>
			<td class="item">都道府県</td>
			<td class="item">市区町村</td>
			<td class="item" width="10%">&nbsp;</td>
		</tr>
		@foreach ($ziplist as $zlist)
			<tr>
				<td>{{ $zlist->zip_code }}</td>
				<td>{{ $zlist->zip_pref }}</td>
				<td>{{ $zlist->zip_city }}{{ $zlist->zip_town }}</td>
				<td align="center">
					<input type="button" value="設定" onClick="setParent('{{ $zlist->zip_code }}','{{ $zlist->zip_pref }}','{{ $zlist->zip_city }}{{ $zlist->zip_town }}');">
				</td>
			</tr>
		@endforeach
	</table>
@else
	該当するデータは見つかりませんでした。
@endif

{{---------------------------------------------------------------------------------------}}

</x-guest-layout>
