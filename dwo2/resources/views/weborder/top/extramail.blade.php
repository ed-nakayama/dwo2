<x-app-layout>

<title>メールアドレス追加設定<</title>


{{ html()->form('GET', '/top/extramail/change')->attribute('name', 'frm')->style('margin:0px;')->open() }}
{{ html()->form()->close() }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メールアドレス追加設定</h4>
		</td>
	</tr>
</table>

<table border="0" width="60%">
	<tr>
		<td align="left">
			購入確認などのメール送信先を追加設定することができます。（１件のみ可能）
		</td>
	<tr>
</table>
<br />
<table border="0" width="60%">
	<tr>
		<td nowrap>
			現在の追加メールアドレス：　
			@if (!empty(Auth::user()->profile_extra_mail))
				{{ Auth::user()->profile_extra_mail }}
			@else
				なし
			@endif
		</td>


	</tr>
	<tr>
		<td nowrap>
			現在の受信設定：　
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
