<x-app-layout>

<title>別途納品先　選択</title>

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
	function returnDeliverySelect(seq_num) {
		document.frmSeq.frm_delivery_seq.value = seq_num;
		document.frmSeq.resetDeliverySubmit.value = "on";
		document.frmSeq.resetDeliveryPerson.value = document.getElementsByName("person_"+seq_num)[0].value;
		document.frmSeq.submit();
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

<br /><table width="700px" border="0">
	<tr>
		<td>
		<h4 class="select">▼別途納品先　選択</h4>
		</td>
	</tr>
</table>

@foreach ($errors->all() as $error)
	<font color=red><li>{{ $error }}</font></li>
@endforeach

{{ html()->form('POST', '/delivery/select')->attribute('name', 'frmSeq')->open() }}
{{ html()->hidden('frm_delivery_seq') }}
{{ html()->hidden('resetDeliverySubmit') }}
{{ html()->hidden('resetDeliveryPerson') }}
{{ html()->form()->close() }}


{{ html()->form('POST', '/delivery/other')->attribute('name', 'frm')->open() }}

<table border="0">
	<tr>
		<td>
		すでに登録済みの納品先については、検索する事ができます。<br />
		新たに納品先を追加される場合は納品先新規登録ボタンをクリックして下さい。
		</td>
	</tr>
	<tr>
		<td class="search" width="470px">
		▼検索条件
		</td>
	</tr>

	<tr>
		<td align="center">
			<br /><table class="select" border="1" cellspacing="1" frame="hsides" rules="rows">
				<tr>
					<td class="item">納品先コード</td>
					<td>
						{{ html()->text('frm_delivery_seq', $frm_delivery_seq)->attribute('maxlength', '10') }}
					</td>
				</tr>
				<tr>
					<td class="item">納品先名称</td>
					<td>
						{{ html()->text('frm_delivery_name', $frm_delivery_name)->attribute('maxlength', '50') }}
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

<br />


<table border="0" cellspacing="0">
	<tr>
		<td class="search">
		▼検索結果
		</td>
		<td class="search" align="right">
			該当数&nbsp;
			{{ number_format($OtherListCount) }}
		</td>
	</tr>
@if (!empty($OtherList[0]))
	<tr>
		<td colspan="2" height="100px">
		<table class="select" border="1" cellspacing="0">
				<tr>
					<td class="item">納品先コード</td>
					<td class="item" width="200px">納品先名称</td>
					<td class="item" align="center">電話番号</td>
					<td class="item" align="center">担当者</td>
					<td class="item" align="center">選択</td>
				</tr>
				@foreach ($OtherList  as $other)
					<tr>
						<td>{{ $other->delivery_seq }}</td>
						<td>{{ $other->delivery_name }}</td>
						<td>{{ $other->delivery_tel }}</td>
						<td>
							{{ html()->text('person_' . $other->delivery_seq, $other->delivery_name_of_charge)->attribute('maxlength', '8') }}
						</td>
						<td>
							<input type="button" value="決定" onClick="returnDeliverySelect('{{ $other->delivery_seq }}');">
						</td>
					</tr>
				@endforeach

			</table>
		</td>
	</tr>
@else
	<tr>
		<td colspan="2" height="100px" width="490px">
			該当納品先はありません。
		</td>
	</tr>
@endif
	<tr>
		<td colspan="2" align="center">
			<div id="next">
				<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
				<a href="/delivery/other/regist"><img src="{{ asset('assets/cust/img/newdelivery.png') }}" alt="納品先新規登録" width="120px" height="50px"></a>
			</div>
		</td>
	</tr>
</table>

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
