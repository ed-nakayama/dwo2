<x-app-layout>

<title>納品先削除</title>

<script type="text/javascript">
<!--
	function DeliveryDelSubmit() {
		if (window.confirm("この納品先を削除してもよろしいですか？")) {
			document.frm.submit();
		}
	}
-->
</script>

<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼納品先削除</h4>
		</td>
	</tr>
</table>

@if (!empty($deliveryData))
{{ html()->form('POST', '/top/delivery/delete')->attribute('name', 'frm')->style('margin:0px;')->open() }}
{{ html()->hidden('del_delivery_seq', $deliveryData->delivery_seq) }}
{{ html()->form()->close() }}
@endif

<table width="450px">
	<tr>
		<td class="search">
		▼納品先確認
		</td>
	</tr>
	<tr>
		<td align="center">
			@if (!empty($deliveryData))
			<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">納品先コード</td>
					<td>{{ $deliveryData->delivery_cust_code }}</td>
				</tr>
				<tr>
					<td class="item">納品先名称</td>
					<td>{{ $deliveryData->delivery_name }}</td>
				</tr>
				<tr>
					<td class="item">納品先担当者</td>
					<td>{{ $deliveryData->delivery_name_of_charge }}</td>
				</tr>
				<tr>
					<td class="item">納品先郵便番号</td>
					<td>{{ $deliveryData->delivery_zip }}</td>
				</tr>
				<tr>
					<td class="item">納品先住所(都道府県/市区町村)</td>
					<td width="200px">{{ $deliveryData->pref_view . $deliveryData->delivery_add1 }}</td>
				</tr>
				<tr>
					<td class="item">納品先住所(番地)</td>
					<td width="200px">{{ $deliveryData->delivery_add2 }}</td>
				</tr>
				<tr>
					<td class="item">納品先住所(ビル･マンション)</td>
					<td>{{ $deliveryData->delivery_add3 }}</td>
				</tr>
				<tr>
					<td class="item">納品先電話番号</td>
					<td>{{ $deliveryData->delivery_tel }}</td>
				</tr>
				<tr>
					<td class="item">納品先FAX番号</td>
					<td>{{ $deliveryData->delivery_fax }}</td>
				</tr>
			</table>
			@endif
		</td>
	</tr>
	<tr>
		<td align="center">
			<div id="next">
				<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
				<a href="javascript:DeliveryDelSubmit();"><img src="{{ asset('assets/cust/img/delete.png') }}" alt="削除" width="120px" height="50px"></a>
			</div>
		</td>
	</tr>
</table>

</x-app-layout>
