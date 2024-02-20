<x-app-layout>

<title>メール受信設定</title>

{{ html()->form('GET', '/top/mailreceiving/mod')->attribute('name', 'frm')->style('margin:0px;')->open() }}
{{ html()->form()->close() }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メール受信設定</h4>
		</td>
	</tr>
</table>

<table border="0" width="60%">
	<tr>
		<td align="left">
			購入確認などのメールを受信するかどうか設定します。
		</td>
	<tr>
</table>
<br />
<table border="0" width="60%">
	<tr>
		<td nowrap>
			登録メールアドレス：　
			@if (!empty(session('agentView')->mail_address))
				{{ session('agentView')->mail_address }}
			@else
				なし
			@endif
		</td>
	</tr>
	<tr>
		<td nowrap>
			登録メールアドレスの受信設定：　
			@if (!empty(Auth::user()->profile_mail_flag))
				受信する
			@else
				受信しない
			@endif
		</td>
	<tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td nowrap>
			追加メールアドレス：　
			@if (!empty(Auth::user()->profile_extra_mail))
				{{ Auth::user()->profile_extra_mail }}
			@else
				なし
			@endif
		</td>
	</tr>
	<tr>
		<td nowrap>
			追加メールアドレスの受信設定：　
			@if (!empty(Auth::user()->profile_extra_mail_flag))
				受信する
			@else
				受信しない
			@endif
		</td>
	<tr>
</table>

<br />
<a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/reset.png') }}" alt="修正" width="120px" height="50px"></a>

</x-app-layout>
