<x-app-layout>

<title>弥生 Web Order</title>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}


<table width="550px">
	<tr>
		<td>
		<h4>▼システムエラーが発生しました</h4>
		</td>
	</tr>
</table>

<p class="words">
<span id="essential">「戻る」ボタンで前画面に戻り、再度「確定」ボタンをクリックしてください。</span><br /><br />
再び当画面が表示される場合は、お手数ですが<br />
{{ config('dwo.DWO_UNIT_NAME') }}までお問い合わせください。<br /><br />
■お問い合せ先■<br />
{{ config('dwo.DWO_COMP_NAME') }} {{ config('dwo.DWO_UNIT_NAME') }}<br />
TEL:{{ config('dwo.DWO_TEL') }}　FAX:{{ config('dwo.DWO_FAX') }}<br />
メールアドレス：{{ config('dwo.DWO_ORDER_CENTER_MAIL') }}<br />
受付時間: 9:30～12:00/13:00～17:30<br />
(土・日・祝日、および弊社休業日を除きます）<br />
</span>
</p>

<br /><br />
<table border="0" cellspacing="0">
	<tr>
		<td align="center" colspan="2">
			<a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
		</td>
	</tr>
</table>


{{---------------------------------------------------------------------------------------}}

</x-app-layout>
