<x-app-layout>

<title>webオーダー履歴</title>

<script type="text/javascript">
<!--
-->
</script>

{{ html()->form('POST', '/top/history/mail/do')->attribute('name', 'frm')->open() }}
	<input type="hidden" name="chg_order_num" value="{{ $chg_order_num }}">
	<input type="hidden" name="old_mail_addr" value="{{ $old_mail_addr }}">
	<input type="hidden" name="new_mail_addr" value="{{ $new_mail_addr }}">
{{ html()->form()->close() }}

<br /><table width="550px">
	<tr>
		<td>
		<h4>▼メールアドレス変更確認</h4>
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
		<td nowrap>現在のメールアドレス：　{{ $old_mail_addr }}</td>
		<td>&nbsp;</td>
	<tr>
	<tr>
		<td nowrap>変更後のメールアドレス：　{{ $new_mail_addr }}</td>
		<td>&nbsp;</td>
	<tr>
</table>

<br /><a href="javascript:history.back();"><img src="{{ asset('assets/cust/img/back.png') }}" alt="戻る" width="120px" height="50px"></a>
　<a href="#" onClick="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/next.png') }}" alt="次へ" width="120px" height="50px"></a>

</x-app-layout>
