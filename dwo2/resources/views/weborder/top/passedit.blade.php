<x-app-layout>

<title>パスワード修正</title>


<table width="550px">
	<tr>
		<td>
		<h4 class="select">▼パスワード修正</h4>
		</td>
	</tr>
</table>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

{{ html()->form('POST', '/top/passedit/do')->attribute('name', 'frm')->style('margin:0px;')->open() }}
<table>
	<tr>
		<td>
			@if ($alertMsg == "on")
				<span id="essential">初回ログインまたは、前回のご利用から３ヶ月以上経過しております。<br />
				安全の為パスワードを変更してください。</span><br /><br />
			@endif
			パスワード（半角英数字記号8～64文字、英字の大文字小文字は区別されます。）<br />
		</td>
	</tr>
	<tr>
		<td>
		<table class="select" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item">古いパスワード</td>
				<td>
					{{ html()->text('current-password')->attributes(['size' => '26', 'maxlength' => '64']) }}
					&nbsp;<span id="essential">*</span>ログイン時に入力したパスワードを入力して下さい
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード</td>
				<td>
					{{ html()->text('new-password')->attributes(['size' => '26', 'maxlength' => '100']) }}
					&nbsp;<span id="essential">*</span>変更した新しいパスワードを入力してください。
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード(確認)</td>
				<td>
					{{ html()->text('new-password_confirmation')->attributes(['size' => '26', 'maxlength' => '100']) }}
					&nbsp;<span id="essential">*</span>確認のためもう一度上記のパスワードを入れてください。
				</td>
			</tr>
		</table><br />
		</td>
	</tr>
	<tr>
		<td>
			{{-- 更新成功メッセージ --}}
			@if (session('update_password_success'))
				<div class="alert alert-success" style="color:#0000ff;">
					{{session('update_password_success')}}
				</div>
			@endif
		</td>
	</tr>
	<tr>
		<td align="center">
			<div id="next">
				<a href="javascript:window.close();"><img src="{{ asset('assets/cust/img/close.png') }}"></a>
				<a href="javascript:document.frm.submit();"><img src="{{ asset('assets/cust/img/reset.png') }}" alt="修正" width="120px" height="50px"></a>
			</div>
		</td>
	</tr>
</table>

{{ html()->form()->close() }}

</x-app-layout>
