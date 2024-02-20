<html>
<x-app-layout>

<title>追加メール変更</title>

{{ html()->form('POST', '/top/extramail/confirm')->attribute('name', 'frm')->style('margin:0px;')->open() }}
{{ html()->hidden('old_mail', Auth::user()->profile_extra_mail) }}
{{ html()->hidden('old_mail_flg', Auth::user()->profile_extra_mail_flag) }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼追加メール変更</h4>
		</td>
	</tr>
</table>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

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
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td>
			現在の受信設定：　
			@if (!empty(Auth::user()->profile_extra_mail_flag))
				受信する
			@else
				受信しない
			@endif
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows" width="100%">
			<tr>
				<td class="item" width="200px">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
				<td>
					{{ html()->text('mail')->attributes(['size' => '40', 'maxlength' => '80']) }}
				</td>
			</tr>
			<tr>
				<td class="item" valign="bottom">メールアドレス確認<span id="essential">*</span><span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
				<td>
					{{ html()->text('mail_confirmation')->attributes(['size' => '40', 'maxlength' => '80']) }}
				</td>
			</tr>
			<tr>
				<td class="item" >受信設定</td>
				<td>
					<input type="radio" id="t1" name="mail_flg" value="1" checked /><label for="t1">受信する</label>
					<input type="radio" id="t2" name="mail_flg" value="0" /><label for="t2">受信しない</label>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

{{ html()->form()->close() }}

<br /><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>

</x-app-layout>
