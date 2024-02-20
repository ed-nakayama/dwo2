<html>
<head>
<meta http-equiv="Content-Type"content="text/html;charset=utf-8">
<link rel="stylesheet"type="text/css"href="../css/common.css">
<title>注文確認書</title>
</head>
<body>
<center>
<div id="main">

<br />
<table border="1" cellspacing="0" frame="border" rules="none" width="600">
  <tr>
    <td nowrap align="center">
		<b>注　文　確　認　書</b>
		</td>
	</tr>
  <tr>
    <td nowrap align="right" bgcolor="white">
		受付No. {{ $orderheader->web_order_num }}<br />
		受付日：{{ substr($orderheader->dwo_last_update,0,4) }}年{{ substr($orderheader->dwo_last_update,5,2) }}月{{ substr($orderheader->dwo_last_update,8,2) }}日<br />
		</td>
	</tr>
  <tr>
    <td nowrap align="left" bgcolor="white">
    	{{ $agentView->name1 .  $agentView->name2 }}&nbsp;&nbsp;
    	@if (!empty($orderheader->dwo_order_person_name) )
    		{{ $orderheader->dwo_order_person_name }}&nbsp;&nbsp;様
    	@else
    		御中
    	@endif
    <br /><br />
	</td>
  </tr>
  <tr>
		<td>
			<table border="0">
				<tr>
					<td width="280px"></td>
			    <td>
					<table border="0">
						<tr>
							<td nowrap align="center">{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}</td>
						</tr>
						<tr>
							<td nowrap>&nbsp;〒{{ config('dwo.DWO_ZIP') }}</td>
						</tr>
						<tr>
							<td nowrap align="center">{{ config('dwo.DWO_ADDRESS') }}</td>
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
		<br /><br /><b><u>合計金額￥{{ number_format($orderheader->total_amt) }}</u></b><br /><br />
		</td>
	</tr>
</table>

<br /><br />

<table>
  <tr>
    <td align="center">
    	<table width="600" border="1" cellspacing="0" cellpadding="2">
    	<tr>
        <td class="item" align="center">貴社発注No.</td>
        <td class="item" align="center">商品コード</td>
        <td class="item" align="center">商品名称</td>
        <td class="item" align="center">数量</td>
        <td class="item" align="center">単価</td>
        <td class="item" align="center">金額</td>
        <td class="item" align="center">消費税</td>
        <td class="item" align="center">消費税率</td></tr>

@foreach ($orderdetailList as $detaillist)
      <tr>
        <td>{{ $detaillist->cust_order_num }}&nbsp;</td>
        <td>{{ $detaillist->item_cd }}</td>
        <td>{{ $detaillist->item_name_kanji }}</td>
        <td align="center">{{ number_format($detaillist->item_vol) }}</td>
        <td align="right">{{ number_format($detaillist->item_price) }}</td>
        <td align="right">{{ number_format($detaillist->item_amt) }}</td>
        <td align="right">{{ number_format($detaillist->tax) }}</td>
        <td align="right">@if (!empty($detaillist->tax_rate)){{ $detaillist->tax_rate * 100 }}@endif</td>
      </tr>
@endforeach

    </table>
		</td>
	</tr>
	<tr>
		<td align="right">
		<table width="150" border="1" cellspacing="0" cellpadding="2">
			<tr>
				<td class="item" align="center">税抜額</td>
				<td align="right">￥&nbsp;{{ number_format($orderheader->order_amt) }}</td>
			</tr>
			<tr>
				<td class="item" align="center">消費税</td>
				<td align="right">￥&nbsp;{{ number_format($orderheader->tax) }}</td>
			</tr>
			<tr>
				<td class="item" nowrap align="center">合計</td>
				<td align="right">￥&nbsp;{{ number_format($orderheader->total_amt) }}</td>
			</tr>
		</table><br />
		</td>
	</tr>
</table>

<table border="0" cellspacing="0" frame="void" rules="none" width="600">
	<tr>
		<td colspan="3">
@include ('weborder/common/tax10_comment')
		</td>
	</tr>

	<tr><td colspan="3" align="left">■納品先■</td></tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			{{ $orderheader->dest_name1 }}{{ $orderheader->dest_name2 }}
			&nbsp;{{ $orderheader->dest_contact_name1 }}
			&nbsp;様
		</td>
	</tr>
	<tr>
		<td align="left" valign="top" nowrap>
			&nbsp;&nbsp;&nbsp;&nbsp;
			〒{{ $orderheader->dest_post }}
		</td>
		<td>&nbsp;</td>
		<td align="left" valign="top">
			@foreach ($prefList as $klist)
				@if ($klist->pref_cd == $orderheader->dest_pref_cd){{ $klist->pref_name }} @endif
			@endforeach
			{{ $orderheader->dest_address1 }}{{ $orderheader->dest_address2 }}{{ $orderheader->dest_address3 }}
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			TEL：{{ $orderheader->dest_tel }}
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>

@if ($orderheader->contents_type == '40')
	<tr><td colspan="3" align="left">■出荷予定日■</td></tr>
@else
	<tr><td colspan="3" align="left">■出荷予定日（即日お客様にご承諾いただいた場合）■</td></tr>
@endif
	<tr>
		<td colspan="3" align="left">
			@if (!empty($orderheader->shipping_date))
				&nbsp;&nbsp;&nbsp;&nbsp;
				{{ substr($orderheader->shipping_date,0,4) }}年
				{{ substr($orderheader->shipping_date,4,2) }}月
				{{ substr($orderheader->shipping_date,6,2) }}日
			@endif
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>

	<tr><td colspan="3" align="left">■サプライ二重梱包■</td></tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			@if ($orderheader->double_package_type == '1')有@else無@endif
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>

	<tr><td colspan="3" align="left">■伝票添付■</td></tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			@if ($orderheader->direct_delivery_type == '1')無@else有@endif
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>

	<tr><td colspan="3" align="left">■備考■</td></tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			{{ $orderheader->deliver_memo }}
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>

	<tr><td colspan="3" align="left">■運賃■</td></tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			当社負担
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>

	<tr><td colspan="3" align="left">■お支払条件■</td></tr>
	<tr>
		<td colspan="3" align="left">
			&nbsp;&nbsp;&nbsp;&nbsp;
			@if ($agentView->close_date1 == '99')末@else{{ $agentView->close_date1 }}日@endif締
			&nbsp;&nbsp;
			@if ($agentView->pay_cycle1 == '0')
				当月
			@elseif ($agentView->pay_cycle1 == '1')
				翌月
			@elseif ($agentView->pay_cycle1 == '2')
				翌々月
			@endif
			@if ($agentView->pay_date1 == '99')末@else{{ $agentView->pay_date1 }}日@endifお支払
		</td>
	</tr>
	<tr><td colspan="3">&nbsp;</td></tr>
</table>

<table border="0" cellspacing="0" frame="void" rules="none" width="600">
	<tr><td align="center">毎度ありがとうございます。<br />ご注文確かに承りました。</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td align="center"><a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a></td></tr>
</table>

</div>
</center>
</body>
</html>
