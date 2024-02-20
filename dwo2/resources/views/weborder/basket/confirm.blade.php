<x-app-layout>

<title>買い物かご確認</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenu('basket') !!}
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

{{ html()->form('POST', '/basket/confirm')->attribute('name' , 'frm')->open() }}

<br /><table class="select" border="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<h4>▼買い物かご確認</h4>
		</td>
	</tr>

	<tr>
		<td><span id="essential">※</span>数量の変更と削除が可能です。入力後、買い物かごを更新ボタンをクリックしてください。<br />
&nbsp;&nbsp;&nbsp;変更ない場合は、次へボタンをクリックしてください。</td>
	</tr>

@foreach ($errors->all() as $error)
	<tr>
		<td>
			<li style="list-style:none; color:red;">{{ $error }}</li>
		</td>
	</tr>
@endforeach

@if ($yosin_error == "on")
	<tr>
		<td align="center">
		<p class="words"><span id="essential">申し訳ございませんが、限度額以上のお受付はできません。<br />
		現在表示されている内容でよろしければこのまま次へお進み下さい。<br />
		または{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}までお問合せください。<br />
		お問合せ先：{{ config('dwo.DWO_TEL') }}</span></p><br />
		</td>
	</tr>
@endif


@if ($basketCount > 0)
	<tr>
		<td align="right">
		<table border="1" cellspacing="0" width="100%">
			<tr align="center">
				<td class="item" width="10%">商品コード</td>
				<td class="item" width="49%">商品名称</td>
				<td class="item" width="9%">@if (isset($orderinfo->upgrade_order) || ($orderinfo->cust_kbn != "OR" && $orderinfo->cust_kbn != "YBP")) 定価@else参考価格@endif</td>
				<td class="item" width="9%">提供価格</td>
				<td class="item" width="8%">数量</td>
				<td class="item" width="9%">金額</td>
				<td class="item" width="6%">削除</td>
			<tr>

	@foreach ($basketList as $basketlist)
			<tr>
				<td align="center">
					{{ $basketlist['product_code'] }}
					{{ html()->hidden('frm_prod_cd[]', $basketlist['product_code'] . '_' . $basketlist['support_code']) }}
				</td>
				<td>&nbsp;{{ $basketlist['item_name_kanji'] }}</td>
				<td align="right">\&nbsp;{{ number_format($basketlist['sales_price']) }}</td>
				<td class="discount" align="right">\&nbsp;{{ number_format($basketlist['price_invoice_price']) }}</td>
				<td align="center">
					{{ html()->text('frm_count_' . $basketlist['product_code'] . '_'  . $basketlist['support_code'], $basketlist['count'])->attributes(['size' => '4', 'maxlength' => '4']) }}
				</td>
				<td align="right">\&nbsp;{{  number_format($basketlist['count'] * $basketlist['price_invoice_price']) }}</td>
				<td align="center">
					{{ html()->checkbox('frm_delchk_' . $basketlist['product_code'] . '_' . $basketlist['support_code'], false  ,'1') }}
				</td>
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
					<table border="1" cellspacing="0" frame="berow" width="100%">
{{--
					<tr>
						<td class="item" width="35%">消費税</td>
						<td width="65%" align="right">\&nbsp;{{ number_format($basketTax) }}</td>
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
			<p>
				{{ html()->submit('買い物かごを更新') }}
			</p>
		</td>
	</tr>
@else
	<tr>
		<td align="left">
			<font  color="red">
				<br>
				買い物かごに，ご注文される商品が見つかりません。<br>
				[商品選択]メニューをクリックし，ご注文される商品を選択して下さい。
			</font>
		</td>
	</tr>
@endif


@if ($orderinfo->pap_order == TRUE)
	<tr>
		<td align="left">
			<br /><br />
					<h4>▼ご注文の流れ</h4>
		</td>
	</tr>
	<tr>
		<td><p><img src="{{ asset('assets/cust/img/procedure.png') }}" alt="ご利用手順" width="750px" height="300px"></p></td>
	</tr>
@endif
	<tr>
		<td align="center">
			<div id="next">
@if ($basketCount > 0)
			<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
			<a href="/order/detailinput"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>
@endif
			</div>
		</td>
	</tr>
</table>
{{ html()->form()->close() }}

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
