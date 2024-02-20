<html>
<head>
<title>shoppingcart</title>
<link rel="stylesheet"type=" text/css" href="{{ asset('assets/cust/css/common.css') }}">
</head>
<body>
@if (!empty($basketList))
	<table border="0" cellspacing="0" width="100%">
	<tr>
		<td align="center">
		<table border="1" cellspacing="0" width="95%">
			<tr align="center">
				<td class="item" width="20%" nowrap>商品コード</td>
				<td class="item" width="50%">商品名称</td>
				<td class="item" width="10%" nowrap>数量</td>
				<td class="item" width="20%" nowrap>提供価格</td>
			</tr>

			@foreach ($basketList as $basketlist)
			<tr>
				<td>{{ $basketlist['product_code'] }}</td>
				<td>{{ $basketlist['item_name_kanji'] }}</td>
				<td align="center">{{ number_format($basketlist['count']) }}</td>
				<td align="right">\&nbsp;{{ number_format($basketlist['count'] * $basketlist['price_invoice_price']) }}</td>
			</tr>
			@endforeach
{{--
			<tr>
				<td class="item" colspan="3">消費税</td>
				<td align="right">\&nbsp;{{ number_format($basketTax) }}</td>
			</tr>
			<tr>
				<td class="item" colspan="3">合計</td>
				<td align="right">\&nbsp;{{ number_format($basketTotal) }}</td>
			</tr>
--}}
			<tr>
				<td class="item" colspan="3">合計(税抜)</td>
				<td align="right">\&nbsp;{{ number_format($basketSubTotal) }}</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="right">（別途消費税）</td>
	</tr>
	</table>

@else
		<table border="0" cellspacing="0">
			<tr>
				<td>
買い物かごに，ご注文される商品が見つかりません。<br>
[商品選択]メニューをクリックし，ご注文される商品を<br>選択して下さい。
				</td>
			</tr>
		</table>

@endif

</body>
</html>