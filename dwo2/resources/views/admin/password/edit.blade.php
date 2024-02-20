<x-admin-layout>

<head>
	<title>パスワード変更</title>
</head>

<style>
.tbl {
	font-size:85%;
	height: 100px;
}

.item {
	background-color : #efffef;
	padding-left : 3px;
	white-space : nowrap;
	}

.astar {
	color:red;
}


</style>

<center>

{{ html()->form('POST', '/admin/password/update')->open() }}

<table>
	<tr>
    <td nowrap align="center" bgcolor="#0000a0">
    	<FONT color="White">パスワード変更</FONT>
    </td>
	</tr>
	<tr>
		<td>
			@foreach ($errors->all() as $error)
				<li style="list-style:none; color:red;">{{ $error }}</li>
			@endforeach
		</td>
	</tr>
	<tr>
		<td>
		<table class="tbl" border="1" cellspacing="0" frame="hsides" rules="rows">
			<tr>
				<td class="item">古いパスワード</td>
				<td>
					{{ html()->text('current-password')->attributes(['size' => '26', 'maxlength' => '64']) }}
					&nbsp;<span class="astar">*</span>ログイン時に入力したパスワードを入力して下さい
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード</td>
				<td>
					{{ html()->text('new-password')->attributes(['size' => '26', 'maxlength' => '100']) }}
					&nbsp;<span class="astar">*</span>変更した新しいパスワードを入力してください。
				</td>
			</tr>
			<tr>
				<td class="item">新しいパスワード(確認)</td>
				<td>
					{{ html()->text('new-password_confirmation')->attributes(['size' => '26', 'maxlength' => '100']) }}
					&nbsp;<span class="astar">*</span>確認のためもう一度上記のパスワードを入れてください。
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<br>
{{-- 更新成功メッセージ --}}
@if (session('status'))
	<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="text-sm text-blue-400 dark:text-blue-400" style="color: blue;">{{ session('status') }}</p>
@endif
{{ html()->submit('更新') }}
{{ html()->form()->close() }}

</center>

</x-admin-layout>
