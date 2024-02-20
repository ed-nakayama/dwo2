<x-guest-layout>

<title>お客様情報承認</title>


<script type="text/javascript">
 
// 自windowを閉じる
function winClose() {
  open('about:blank', '_self').close();    //一度再表示してからClose
}
 
</script>

<br>
@if (session('acceptance_action') == "ok")
承認を確認しました。ありがとうございます。
@else
否認を確認しました。
@endif
<br/><br/>
{{ html()->button('閉じる')->attribute('onClick', 'winClose();') }}

</x-guest-layout>
