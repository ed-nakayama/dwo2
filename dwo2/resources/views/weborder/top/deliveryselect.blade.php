<x-app-layout>

<title>納品先選択</title>


<script type="text/javascript">
<!--
	function viewDeliveryDetail(seq_num) {
		document.frmSeq.frm_delivery_seq.value = seq_num;
		document.frmSeq.submit();
	}
-->
</script>

<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼納品先選択</h4>
		</td>
	</tr>
</table>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

{{ html()->form('POST', '/top/delivery/detail')->attribute('name', 'frmSeq')->style('margin:0px;')->open() }}
{{ html()->hidden('frm_delivery_seq', '') }}
{{ html()->form()->close() }}

{{ html()->form('POST', '/top/delivery')->attribute('name', 'frm')->style('margin:0px;')->open() }}

<table border="0" width="500px">
		<td class="search">
		▼検索条件
		</td>
	</tr>
	<tr>
		<td align="center">
			<br /><table class="new" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">納品先コード</td>
					<td>
						{{ html()->text('frm_delivery_seq', $frm_delivery_seq)->attribute('maxlength', '10') }}
					</td>
				</tr>
				<tr>
					<td class="item">納品先名称</td>
					<td>
						{{ html()->text('frm_delivery_name', $frm_delivery_name)->attributes(['size' => '50', 'maxlength' => '50']) }}
					</td>
				</tr>
				<tr>
					<td class="item">電話番号</td>
					<td>
						{{ html()->text('frm_delivery_tel', $frm_delivery_tel)->attribute('maxlength', '13') }}
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><br />
			<a href="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/search.png') }}" alt="検索" width="120px" height="50px"></a>
		</td>
	</tr>
</table>
{{ html()->form()->close() }}

<br>
<table border="0" cellspacing="0">
	<tr>
		<td class="search">
		▼検索結果
		</td>
		<td class="search" align="right">
		該当数&nbsp;{{ $OtherListCount }}
		</td>
	</tr>
@if ($OtherListCount > 0)
	<tr>
		<td colspan="2" height="100px">
		<table border="1" cellspacing="0">
				<tr>
					<td class="item" align="center">納品先コード</td>
					<td class="item" width="200px">納品先名称</td>
					<td class="item" width="70px" align="center">電話番号</td>
					<td class="item" width="85px" align="center">担当者</td>
					<td class="item" align="center">詳細</td>
				</tr>
				@foreach ($OtherList as $otherlist)
				<tr>
					<td>{{ $otherlist->delivery_seq }}</td>
					<td>{{ $otherlist->delivery_name }}</td>
					<td align="center">{{ $otherlist->delivery_tel }}</td>
					<td align="center">&nbsp;{{ $otherlist->delivery_name_of_charge }}</td>
					<td>
						{{ html()->submit('詳細')->attribute('onClick', "viewDeliveryDetail($otherlist->delivery_seq);") }}
					</td>
				</tr>
				@endforeach
			</table>
		</td>
	</tr>
@else
	<tr>
		<td colspan="2" height="100px" width="490px">
			該当納品先はありません。<br><br>
		</td>
	</tr>
@endif
	<tr>
		<td align="center" colspan="2">
			<br>
			<a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a>
		</td>
	</tr>
</table>

</x-app-layout>
