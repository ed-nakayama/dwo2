<x-app-layout>

<title>メール受信設定変更<</title>


{{ html()->form('POST', '/top/mailreceiving/confirm')->attribute('name', 'frm')->style('margin:0px;')->open() }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メール受信設定変更</h4>
		</td>
	</tr>
</table>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

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
			<input type="radio" id="m1" name="mail_flg" value="1" @if (Auth::user()->profile_mail_flag == 1) checked @endif /><label for="m1">受信する</label>
			<input type="radio" id="m2" name="mail_flg" value="0" @if (Auth::user()->profile_mail_flag == 0) checked @endif /><label for="m2">受信しない</label>
		</td>
	</tr>
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
			<input type="radio" id="em1" name="extra_mail_flg" value="1" @if (Auth::user()->profile_extra_mail_flag == 1) checked @endif /><label for="em1">受信する</label>
			<input type="radio" id="em2" name="extra_mail_flg" value="0" @if (Auth::user()->profile_extra_mail_flag == 0) checked @endif/><label for="em2">受信しない</label>
		</td>
	<tr>
</table>

{{ html()->form()->close() }}

<br /><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>

</x-app-layout>
