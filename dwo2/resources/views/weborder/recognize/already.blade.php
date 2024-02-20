<x-guest-layout>

<title>お客様情報承認</title>

<script type="text/javascript">
 
// 自windowを閉じる
function winClose() {
  open('about:blank', '_self').close();    //一度再表示してからClose
}
 
</script>

@if ($order_acceptance_flag == "1")
以下の注文はすでに承認済みです。このままウインドウを閉じてください。
@elseif ($order_acceptance_flag == "2")
以下の注文はすでに否認済みです。このままウインドウを閉じてください。
@elseif ($order_acceptance_flag == "3")
以下の注文はすでに期限切れです。このままウインドウを閉じてください。
@elseif ($order_acceptance_flag == "99")
以下の注文はすでに削除されています。このままウインドウを閉じてください。
@endif

<br/><br/>
受付No.{{ session()->get('acceptance')['order_acceptance_header_no'] }}



<table border=1>
	<tr>
		<td bgcolor="#8080c0">商品コード</td>
		<td bgcolor="#8080c0">商品名称</td>
		<td bgcolor="#8080c0">数量</td>
	</tr>
	@foreach (session()->get('weborderdetailList') as $detaillist)
		<tr>
			<td align="center">{{ $detaillist['item_cd'] }}</td>
			<td>{{ $detaillist['item_name_kanji'] }}</td>
			<td align="center">{{ $detaillist['item_vol'] }}</td>
		</tr>
	@endforeach
</table>

<br/>
{{ html()->button('閉じる')->attribute('onClick', 'winClose();') }}

</x-guest-layout>
