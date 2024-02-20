<html>
<x-app-layout>

<title>追加メール変更確認</title>

{{ html()->form('POST', '/top/extramail/store')->attribute('name', 'frm')->style('margin:0px;')->open() }}
{{ html()->hidden('mail', $mail) }}
{{ html()->hidden('mail_flg', $mail_flg) }}
{{ html()->form()->close() }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼追加メール変更確認</h4>
		</td>
	</tr>
</table>

<table border="0" width="60%">
	<tr>
		<td align="left"><span id="essential">
		以下の内容でよろしければ「次へ」ボタンをクリックして下さい。<br /><br /></span>
		</td>
	<tr>
</table>

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
	<tr>
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
	<tr>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td nowrap>変更後のメールアドレス：　{{ $mail }}</td>
	<tr>
	<tr>
		<td nowrap>
			変更後の受信設定：　
			@if ($mail_flg)
				受信する
			@else
				受信しない
			@endif
		</td>
	<tr>
</table>

<br /><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>

</x-app-layout>
