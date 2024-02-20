<x-guest-layout>

<title>お客様情報承認</title>

<br>
@if ($exec == "ok")
承認します。
@else
否認します。
@endif
よろしいですか。<br/><br/>

{{ html()->form('POST', '/recognize/do')->attribute('name', 'frm')->style('margin:0px;')->open() }}
{{ html()->hidden('acceptance_action', $exec) }}
{{ html()->submit('はい')->attribute('name', 'do') }}
{{ html()->button('いいえ')->attributes(['name' => 'cancel', 'onClick' => 'javascript:history.back();return false;']) }}
{{ html()->form()->close() }}

</x-guest-layout>
