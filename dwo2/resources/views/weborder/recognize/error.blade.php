<x-guest-layout>

<title>お客様情報承認</title>

<script type="text/javascript">
 
// 自windowを閉じる
function winClose() {
  open('about:blank', '_self').close();    //一度再表示してからClose
}
 
</script>
<BR>
@if (!empty($error_message) )
	<li style="list-style:none; color:red;">{{ $error_message }}</li>
@endif

<br>
<br>
{{ html()->button('戻る')->attributes(['name' => 'button', 'onClick' => 'javascript:history.back();']) }}
{{ html()->button('閉じる')->attributes(['name' => 'button', 'onClick' => 'winClose();']) }}

</x-guest-layout>
