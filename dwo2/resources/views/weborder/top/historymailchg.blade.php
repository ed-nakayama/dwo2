<x-app-layout>

<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
-->
</script>


{{ html()->form('POST', '/top/history/mail/confirm')->attribute('name', 'frm')->open() }}
	<input type="hidden" name="chg_order_num" value="{{ $chg_order_num }}">
	<input type="hidden" name="old_mail_addr" value="{{ $old_mail_addr }}">

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メールアドレス変更</h4>
		</td>
	</tr>
</table>

@error('chg_order_num')
	<li style="list-style:none; color:red;">{{ $message }}</li>
@enderror
@error('new_mail_addr')
	<li style="list-style:none; color:red;">{{ $message }}</li>
@enderror
<br>

<table border="0" width="60%">
	<tr>
		<td nowrap>現在のメールアドレス：　{{ $old_mail_addr }}</td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td align="center" colspan="2">
		<br /><table class="select" border="1" cellspacing="0" frame="hsides" rules="rows" width="100%">
			<tr>
				<td class="item" width="200px">メールアドレス<span id="essential">*</span><span id="gray">[半角]</span></td>
				<td><input type="text" size="40" maxlength="80" name="new_mail_addr" value="{{ old('new_mail_addr') }}" style="ime-mode: disabled;"></td>
			</tr>
			<tr>
				<td class="item" valign="bottom">メールアドレス確認<span id="essential">*</span><span id="gray">[半角]</span><br /><div id="essential">※確認の為、もう一度入力して下さい</div></td>
				<td><input type="text" size="40" maxlength="80" name="new_mail_addr_confirmation" value="{{ old('new_mail_addr_confirmation') }}" style="ime-mode: disabled;"></td>
			</tr>
		</table>
		</td>
	</tr>
</table>

{{ html()->form()->close() }}

<br /><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>

</x-app-layout>
