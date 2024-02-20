<x-app-layout>

<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
	function dtlSearch(o_num) {
		document.frmDtl.frm_order_num.value = o_num;
		document.frmDtl.submit();
	}

	function nextSearch(pg) {
		document.frm.page.value = pg;
		document.frm.submit();
	}

-->
</script>

<br>
<table width="550px">
	<tr>
		<td>
		<h4>▼注文履歴</h4>
		</td>
	</tr>
</table>

{{ html()->form('POST', '/top/history/detail')->attribute('name', 'frmDtl')->style('margin:0px;')->open() }}
{{ html()->hidden('frm_order_num') }}
{{ html()->hidden('frm_from_date',             $frm_from_date) }}
{{ html()->hidden('frm_to_date',               $frm_to_date) }}
{{ html()->hidden('frm_web_order_num',         $frm_web_order_num) }}
{{ html()->hidden('frm_item_cd',               $frm_item_cd) }}
{{ html()->hidden('frm_dwo_order_person_name', $frm_dwo_order_person_name) }}
{{ html()->hidden('frm_direct_delivery_type',  $frm_direct_delivery_type) }}
{{ html()->hidden('frm_dest_name1',            $frm_dest_name1) }}
{{ html()->hidden('frm_state_type',            $frm_state_type) }}
{{ html()->form()->close() }}

{{ html()->form('POST', '/top/history/search')->attribute('name', 'frm')->open() }}

<table border="0" width="560px">
	<tr>
		<td height="130px">
■ステータスとは■<br />
現在の処理状況を指しています。<br />
<br />
<table border="0">
<tr>
<td>【受付中】とは</td><td>：　ご注文確定後、弊社営業日15時までの状態　&lt;ご注文の削除が可能です&gt;</td>
</tr>
<tr>
<td>【出荷手配済】とは</td><td>：　ご注文確定後、弊社営業日15時を過ぎて出荷手配が完了した状態</td>
</tr>
<tr>
<td>【予約受付中】とは</td><td>：　ご予約を承っている状態　&lt;ご注文の削除が可能です&gt</td>
</tr>
</table>
		</td>
	</tr>
	<tr>
		<td class="search">
		▼検索条件
		</td>
	</tr>
	@foreach ($errors->all() as $error)
		<tr>
			<td>
				<li style="list-style:none; color:red;">{{ $error }}</li>
			</td>
		</tr>
	@endforeach
	<tr>
		<td align="center" height="200px">
			<br /><table class="new" border="1" cellspacing="0" frame="hsides" rules="rows">
				<tr>
					<td class="item">受付日(YYYY-MM-DD)</td>
					<td>
						{{ html()->text('frm_from_date', $frm_from_date)->attribute('maxlength', '10') }}
						～
						{{ html()->text('frm_to_date', $frm_to_date)->attribute('maxlength', '10') }}
					</td>
				</tr>
				<tr>
					<td class="item">受付No.</td>
					<td>
						{{ html()->text('frm_web_order_num', $frm_web_order_num)->attribute('maxlength', '10') }}
					</td>
				</tr>
				<tr>
					<td class="item">商品コード</td>
					<td>
						{{ html()->text('frm_item_cd', $frm_item_cd)->attribute('maxlength', '15') }}
					</td>
				</tr>
				<tr>
					<td class="item">貴社担当者</td>
					<td>
						{{ html()->text('frm_dwo_order_person_name', $frm_dwo_order_person_name)->attribute('maxlength', '100') }}
					</td>
				</tr>
				<tr>
					<td class="item">納品先形態</td>
					<td>
					&nbsp;<select name="frm_direct_delivery_type">
						{{ html()->option('選択して下さい') }}
						{{ html()->option('貴社'      , '0' , ($frm_direct_delivery_type == "0")) }}
						{{ html()->option('別途納品先', '1' , ($frm_direct_delivery_type == "1")) }}
					</td>
				</tr>
				<tr>
					<td class="item">別途納品先名称</td>
					<td>
						{{ html()->text('frm_dest_name1', $frm_dest_name1)->attributes(['size' => '50' ,'maxlength', '50']) }}
					</td>
				</tr>
				<tr>
					<td class="item">
					ステータス
					</td>
					<td>
					&nbsp;
						<select name="frm_state_type">
							<option class="gray" value="">選択して下さい</option>
							@foreach ($orderStatus as $list)
								@if (in_array($list->order_status_id, [0, 1, 4, 8, 9]) )
								{{ html()->option($list->order_status_name, $list->order_status_id ,($frm_state_type ==  $list->order_status_id)) }}
								@endif
							@endforeach
						</select>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
		<br /><a href="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/search.png') }}" alt="検索" width="120px" height="50px"></a>
		</td>
	</tr>
</table>

{{ html()->form()->close() }}

<table border="0" cellspacing="0">
	<tr>
		<td colspan="2" height="100px">
		<span id="essential">※</span>
		納品先の検索は、納品先形態で貴社か貴社以外(別途納品先)に分けて行って下さい。<br />
		なお、別途納品先を指定した場合は、納品先名称のあいまい検索が可能です。<br />
		</td>
	</tr>
	<tr>
		<td class="search">
		▼検索結果
		</td>
		<td class="search" align="right">
		該当数&nbsp;@if (empty($orderList[0]))0 @else{{ $orderList->total() }}@endif
		</td>
	</tr>
	<tr>
		<td colspan="2" height="100px">
@if (empty($orderList[0]))
@elseif ($orderList->total() == 0)
			注文データが見つかりませんでした。
@else
			<table border="1" cellspacing="0">
				<tr>
					<td class="item">返品/キャンセル</td>
					<td class="item">受付No.</td>
					<td class="item">受付日</td>
					<td class="item" width="150px">納品先名称</td>
					<td class="item">貴社担当者</td>
					<td class="item">ステータス</td>
					<td class="item" align="center">詳細</td>
				</tr>
				@foreach ($orderList  as $order)
				<tr>
					<td align="center"><font color="red">　@if ($order->reti_state_type == '2')返品@endif @if ($order->cc_header_del_type == '1')キャンセル@endif</font></td>
					<td>{{ $order->web_order_num }}</td>
					<td>{{ $order->dwo_last_update }}</td>
					@if (empty($order->dest_name1))
						<td align="center">－－－－－</td>
					@else
						<td align="center">{{ $order->dest_name1 }}{{ $order->dest_name2 }}</td>
					@endif
					<td>{{ $order->dwo_order_person_name }}&nbsp;</td>
					<td align="center">
						@foreach ($orderStatus as $stat)
							@if ($order->state_type == $stat->order_status_id)
								{{ $stat->order_status_name }}
							@endif
						@endforeach
					</td>
					<td>
						{{ html()->submit('詳細')->attribute('onClick', "dtlSearch($order->web_order_num);") }}
					</td>
				</tr>
				@endforeach
			</table>
@endif
		</td>
	</tr>
	@if(isset($orderList[0]))
	<TABLE cellspacing="0" cellpadding="2" align="center">
		<TR>
			<th nowrap>
				<div class="pager">
					{{ $orderList->appends(request()->query())->links('vendor.pagination.user') }}
				</div>
			</th>
		</TR>
	</TABLE>
	@endif
	<tr>
		<td align="center" colspan="2">
			<a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a>
		</td>
	</tr>
</table>



</x-app-layout>
