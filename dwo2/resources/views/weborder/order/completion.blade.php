<x-app-layout>

<title>ユーザー登録済み製品</title>

<x-slot name="menu">
	{!! App\Http\Controllers\Weborder\MenuManager::setMenuComplete() !!}
</x-slot>

@if (session('agentView')->cust_class_code != "OR" && session('agentView')->cust_class_code != "YBP" )
<x-slot name="manual">
</x-slot>
@endif

{{---------------------------------------------------------------------------------------}}


<script type="text/javascript">
<!--
	function printPreview() {
		document.frmPrt.submit();
	}
-->
</script>

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

{{ html()->form('POST', '/order/printview')->attributes(['name' => 'frmPrt', 'target' => '_blank'])->open() }}
{{ html()->hidden('orderNum' ,session('ORDER_SEQ_NO')) }}
{{ html()->form()->close() }}

<br /><table width="550px">
	<tr>
		<td>
		<br /><h4 class="select">▼オーダー完了</h4>
		</td>
	</tr>
</table>

<table>
@if (session('syonin_mail_flg') == "1")
	<tr>
		<td>
		ご注文いただきまして誠にありがとうございます。<br />
		<span id="essential"><b>「注文確認書」を印刷し、請求書がお手元に届くまで必ず保管してください。</b></span><br /><br />
<pre>
<span id="essential">※</span>ご購入のお客様（ユーザー登録のお客様）に「個人情報保護方針」についての承認確認メールを送信しました。
　到着後２週間以内に「承認」していただければご注文の受け付けが完了します。
　「否認」の場合、ご注文はキャンセルされます。
</pre>
<br /><br />
</td>
	</tr>
@else
	<tr>
		<td>
		ご注文いただきまして誠にありがとうございます。<br /><br />
		<span id="essential"><b>「注文確認書」を印刷し、請求書がお手元に届くまで必ず保管してください。</b></span><br /><br />
		</td>
	</tr>
@endif

	<tr>
		<td align="center">
		■受付No.&nbsp;{{ session('ORDER_SEQ_NO') }}■<br /><br />
		</td>
	</tr>
</table>

<table border="0" width="700">
	<tr>
		<td width="40%">&nbsp;</td>
		<td align="center">
			<a href="javascript:printPreview();"><img src="{{ asset('assets/cust/img/print.png') }}" alt="注文確認書" width="120px" height="50px"></a>
		</td>
		<td width="40%" align="right" valign="bottom">
		<a href="/home">次のご注文を入力する場合はこちら</a>
		</td>
	</tr>
</table>

{{---------------------------------------------------------------------------------------}}

</x-app-layout>
