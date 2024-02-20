<x-app-layout>

<title>ユーザー登録済み製品 or 通常製品</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('order') !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}

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

{{ html()->form('POST', '/delivery/select')->attribute('name' , 'frm')->open() }}
{{ html()->hidden('orderDetailSubmit', 'on') }}

@if ($basketCount > 0)
<br /><table border="0">
	<tr>
		<td>
		<h4>▼オーダー詳細入力</h4>
		</td>
	</tr>
	<tr>
		<td>
		<span id="essential">※</span>入力項目のご説明は<a href="/order/notes">こちら</a><br />
		</td>
	</tr>
	<tr>
		<td>
		<br />
		<table class="select" border="1" cellspacing="0">
			<tr>
				<td class="item">貴社発注No.&nbsp;[20桁/半角]</td>
				<td class="item">商品コード</td>
				<td class="item" width="300px" align="center">商品名称</td>
				<td class="item" width="50px" align="center">@if (isset($orderinfo->upgrade_order) || ($orderinfo->cust_kbn != "OR" && $orderinfo->cust_kbn != "YBP")) 定価@else参考価格@endif</td>
				<td class="item" width="50px">提供価格</td>
				<td class="item" width="30px">数量</td>
				<td class="item" width="50px" align="center">金額</td>
			<tr>

			@foreach ($basketList as $basketlist)
				<tr>
					<td>
						{{ html()->text('frm_cust_order_num_' . $basketlist['product_code'] . '_'  . $basketlist['support_code'], $basketlist['cust_order_num'])->attributes(['size' => '20', 'maxlength' => '20']) }}
					</td>
					<td align="center">{{ $basketlist['product_code'] }}</td>
					<td>{{ $basketlist['item_name_kanji'] }}</td>
					<td align="right">\&nbsp;{{ number_format($basketlist['sales_price']) }}</td>
					<td class="discount"align="right">\&nbsp;{{ number_format($basketlist['price_invoice_price']) }}</td>
					<td align="right">{{ $basketlist['count'] }}</td>
					<td align="right">\&nbsp;{{ number_format($basketlist['count'] * $basketlist['price_invoice_price']) }}</td>
				<tr>
			@endforeach

		</table>
		</td>
	</tr>
	<tr>
		<td align="right" width="100%">
			<table border="0" cellspacing="0" frame="berow" width="100%">
			<tr>
				<td align="left" width="77%">
				</td>
				<td width="23%">
					<table class="select" border="1" cellspacing="0" width="100%">
{{--
					<tr>
						<td class="item" width="35%">消費税</td>
						<td align="right" width="65%">\&nbsp;{{ number_format($basketTax) }}</td>
					</tr>
					<tr>
						<td class="item">合計</td>
						<td align="right">\&nbsp;{{ number_format($basketTotal) }}</td>
					</tr>
--}}
					<tr>
						<td class="item">合計(税抜)</td>
						<td align="right">\&nbsp;{{ number_format($basketSubTotal) }}</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td  width="77%">　</td>
				<td align="right">（別途消費税）</td>
			</tr>
			</table>
		</td>
	</tr>
</table>

<br />

<table width="730px" border="0">
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0" frame="hsides" rules="rows"
			<tr>
				<td class="item">貴社ご発注　担当者&nbsp;[8桁/全角]</td>
				<td>
					{{ html()->text('frm_order_tantou_name', $orderinfo->order_tantou_name)->attributes(['size' => '28', 'maxlength' => '8']) }}
				</td>
			</tr>
			<tr>
				<td class="item">サプライ二重梱包</td>
				<td>
					<input type="radio" name="frm_double_package_type" value="1" @if ($orderinfo->double_package_type == 1) CHECKED @endif>有&nbsp;
					<input type="radio" name="frm_double_package_type" value="0" @if ($orderinfo->double_package_type == 0) CHECKED @endif>無
				</td>
			</tr>
			<tr>
				<td class="item">備考&nbsp;[32桁/全角]</td>
				<td>
					{{ html()->text('frm_remarks', $orderinfo->remarks)->attributes(['size' => '50', 'maxlength' => '32']) }}
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

@else
	<font  color="red">
		<br>
		買い物かごに，ご注文される商品が見つかりません。<br>
		[商品選択]メニューをクリックし，ご注文される商品を選択して下さい。
	</font>
@endif

{{ html()->form()->close() }}

@if (!empty($errors->all()) )
<table>
	<tr>
		<td align="center">
			@foreach ($errors->all() as $error)
				<li style="list-style:none; color:red;">{{ $error }}</li>
			@endforeach
		</td>
	</tr>
</table>
@endif

@if ($basketCount > 0)
<table>
	<tr>
		<td align="center">
		<div id="next">
			<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
			<a href="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a></div>
		</td>
	</tr>
</table>
@endif

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
