<x-admin_normal-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           商品検索
        </h2>
    </x-slot>

{{--------------------------------------------------------------------}}

<script type="text/javascript">
<!--
	function setParent(p_num ,p_code ,p_name ,p_price) {
		window.opener.setProd(p_num ,p_code ,p_name ,p_price);
		window.close();
	}
-->
</script>
<h5>商品検索</h5>
{{ $custNum }}　{{ $agentView->name1 . $agentView->name2 }}<br>

<table border="0" cellpadding="0" cellspacing="2">
	<tr>
		<td>
			<p class="sidebar">検索条件</p>
		</td>
	<tr>
</table>
@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

{{ html()->form('GET', '/admin/order/list2/search/prod')->attributes(['name' => 'frm', 'style' => 'margin:0px;'])->open() }}

<table border=1 cellpadding=2 cellspacing=0>
	<tr>
		<td class="item">商品コード</td>
		<td class="item">検索</td>
	</tr>
	<tr>
		<td>
			{{ html()->hidden('num', $num) }}
			{{ html()->hidden('custNum', $custNum) }}
			{{ html()->text('prodCode', $prodCode)->attribute('size', '20') }}
		</td>
		<td>
			<input type="submit" value="検索">
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

@if (!empty($prodList) )
<table border=1 cellpadding=2 cellspacing=0 width="90%">
	<tr>
		<td class="item">商品コード</td>
		<td class="item">商品名</td>
		<td class="item">定価</td>
		<td class="item">仕切り率(%)</td>
		<td class="item">提供価格</td>
		<td class="item" width="10%">&nbsp;</td>
	</tr>
@foreach ($prodList as $list)
	<tr>
		<td style="word-break: break-all;">{{ $list->product_code }}</td>
		<td style="word-break: break-all;">{{ $list->item_name_kanji }}</td>
		<td style="word-break: break-all;" align="right">{{ number_format($list->sales_price) }}</td>
		<td style="word-break: break-all;" align="right">{{ $list->discount_rate }}</td>
		<td style="word-break: break-all;" align="right">{{ number_format($list->price_invoice_price) }}</td>
		<td style="word-break: break-all;" align="center">
			<input type="button" value="設定" onClick="setParent('{{ $num }}','{{ $list->product_code }}','{{ $list->item_name_kanji }}','{{ $list->price_invoice_price }}');">
		</td>
	</tr>
@endforeach
</table>
@else
該当するデータは見つかりませんでした。
@endif

{{--------------------------------------------------------------------}}

</x-admin_normal-layout>
