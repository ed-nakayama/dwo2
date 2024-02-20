@extends('layouts.pdf')

@section('content')

<center>
<div id="main">

@foreach ($orderHeaderList as $orderheader)
@if ($loop->index > 0)
	<div style="page-break-after: always"></div>
@endif

<table style="width:100%;">
	<tr>
		<td nowrap align="center" style="font-size:20px;font-weight:bold;">
			<b>注　文　確　認　書</b>
		</td>
	</tr>
	<tr>
		<td nowrap align="right">
			受付No. {{ $orderheader->web_order_num }}<br />
			受付日：{{ substr($orderheader->dwo_last_update,0,4) }}年{{ substr($orderheader->dwo_last_update,5,2) }}月{{ substr($orderheader->dwo_last_update,8,2) }}日<br />
		</td>
	</tr>
	<tr>
		<td nowrap>
			{{ $orderheader->name1 .  $orderheader->name2 }}&nbsp;&nbsp;
			@if (!empty($orderheader->dwo_order_person_name) )
				{{ $orderheader->dwo_order_person_name }}&nbsp;&nbsp;様
			@else
				御中
			@endif
		</td>
	</tr>
	<tr>
		<td>
			<table style="margin: 0 0 0 auto;">
				<tr>
					<td>
						<table class="tbl-bill">
						<tr>
							<td nowrap align="center">{{ config('dwo.DWO_COMP_NAME') }}　{{ config('dwo.DWO_UNIT_NAME') }}</td>
						</tr>
						<tr>
							<td nowrap>&nbsp;〒{{ config('dwo.DWO_ZIP') }}</td>
						</tr>
						<tr>
							<td nowrap>{{ config('dwo.DWO_ADDRESS') }}</td>
						</tr>
						<tr>
							<td nowrap align="center">TEL:{{ config('dwo.DWO_TEL') }}　FAX:{{ config('dwo.DWO_FAX') }}</td>
						</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<br /><b><u>合計金額￥{{ number_format($orderheader->total_amt) }}</u></b>
		</td>
	</tr>
</table>
<br />

<table style="width:100%;">
	<tr>
		<td align="center">
			<table class="tbl-billdt">
    			<tr>
					<th>貴社発注No.</th>
					<th>商品コード</th>
					<th>商品名称</th>
					<th>数量</th>
					<th>単価</th>
					<th>金額</th>
					<th>消費税</th>
					<th>消費税率</th>
				</tr>

				@foreach ($orderheader->orderDetailList as $detaillist)
				<tr>
					<td align="center">{{ $detaillist->order_line_num }}</td>
					<td align="center">{{ $detaillist->item_cd }}</td>
					<td>{{ $detaillist->item_name_kanji }}</td>
					<td align="right">{{ number_format($detaillist->item_vol) }}</td>
					<td align="right">{{ number_format($detaillist->item_price) }}</td>
					<td align="right">{{ number_format($detaillist->item_amt) }}</td>
					<td align="right">{{ number_format($detaillist->tax) }}</td>
					<td align="right">@if (!empty($detaillist->tax_rate)){{ $detaillist->tax_rate * 100 }}@endif％</td>
				</tr>
				@endforeach

			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table class="tbl-billtotal">
				<tr>
					<th>税抜額</th>
					<td align="right">￥&nbsp;{{ number_format($orderheader->order_amt) }}</td>
				</tr>
				<tr>
					<th>消費税</th>
					<td align="right">￥&nbsp;{{ number_format($orderheader->tax) }}</td>
				</tr>
				<tr>
					<th>合計</th>
					<td align="right">￥&nbsp;{{ number_format($orderheader->total_amt) }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table class="tbl-bill-else">
	<tr>
		<td colspan="3">
@include ('weborder/common/tax10_comment')
		</td>
	</tr>

	<tr>
		<th>■納品先■</th>
	</tr>
	<tr>
		<td>
			{{ $orderheader->dest_name1 }}{{ $orderheader->dest_name2 }}
			&nbsp;{{ $orderheader->dest_contact_name1 }}
			&nbsp;様
		</td>
	</tr>
	<tr>
		<td>
			〒{{ $orderheader->dest_post }}　
			@foreach ($prefList as $klist)
				@if ($klist->pref_cd == $orderheader->dest_pref_cd){{ $klist->pref_name }} @endif
			@endforeach
			{{ $orderheader->dest_address1 }}{{ $orderheader->dest_address2 }}{{ $orderheader->dest_address3 }}
		</td>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			TEL：{{ $orderheader->dest_tel }}
		</td>
	</tr>

@if ($orderheader->contents_type == '40')
	<tr>
		<th>■出荷予定日■</th>
	</tr>
@else
	<tr>
		<th>■出荷予定日（即日お客様にご承諾いただいた場合）■</th>
	</tr>
@endif
	<tr>
		<td style="padding-bottom:10px;">
			@if (!empty($orderheader->shipping_date))
				{{ substr($orderheader->shipping_date,0,4) }}年
				{{ substr($orderheader->shipping_date,4,2) }}月
				{{ substr($orderheader->shipping_date,6,2) }}日
			@endif
		</td>
	</tr>

	<tr>
		<th>■サプライ二重梱包■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			@if ($orderheader->double_package_type == '1')有@else無@endif
		</td>
	</tr>

	<tr>
		<th>■伝票添付■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			@if ($orderheader->direct_delivery_type == '1')無@else有@endif
		</td>
	</tr>

	<tr>
		<th>■備考■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			{{ $orderheader->deliver_memo }}
		</td>
	</tr>

	<tr>
		<th>■運賃■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			当社負担
		</td>
	</tr>

	<tr>
		<th>■お支払条件■</th>
	</tr>
	<tr>
		<td style="padding-bottom:10px;">
			@if ($orderheader->close_date1 == '99')末@else{{ $orderheader->close_date1 }}日@endif締
			&nbsp;&nbsp;
			@if ($orderheader->pay_cycle1 == '0')
				当月
			@elseif ($orderheader->pay_cycle1 == '1')
				翌月
			@elseif ($orderheader->pay_cycle1 == '2')
				翌々月
			@endif
			@if ($orderheader->pay_date1 == '99')末@else{{ $orderheader->pay_date1 }}日@endifお支払
		</td>
	</tr>
</table>

<table style="width:100%;">
	<tr><td align="center">毎度ありがとうございます。<br />ご注文確かに承りました。</td></tr>
</table>

@endforeach

</div>
</center>

@endsection
