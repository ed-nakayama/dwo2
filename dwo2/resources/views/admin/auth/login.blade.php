<x-admin_guest-layout>

<table width="500" border="0" cellspacing="3" cellpadding="0">
	<tr>
		<td nowrap colspan="2" align="center" valign="top">
			{{ html()->form('POST', route('admin.login'))->open() }}
			<table cellspacing="0" cellpadding="2">
				<tr>
					<td nowrap align="center" height="18" bgcolor="#8080ff"><font color="white"><b>　管理者用 ログイン　</b></font></td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						@foreach ($errors->all() as $error)
							<li style="list-style:none; color:red;">{{ $error }}</li>
						@endforeach
					</td>
				</tr>
				<tr>
					<td nowrap align="center">オペレータID</td>
				</tr>
				<tr>
					<td nowrap align="center">
						{{ html()->text('operator_id')->attributes(['size' => '15', 'maxlength' => '15']) }}
					</td>
				</tr>
				<tr>
					<td nowrap align="center">パスワード </td>
				</tr>
				<tr>
					<td nowrap align="center">
						{{ html()->password('password')->attributes(['size' => '15', 'maxlength' => '15']) }}
					</td>
				</tr>
{{--
				<tr>
					<td nowrap align="center">
						{{ html()->checkbox('remember')->id('remember_me') }} 記憶する
					</td>
				</tr>
--}}
				<tr>
					<td nowrap align="center">
						<a href="{{ route('admin.password.request') }}">パスワードを忘れてしまったら</a>
					</td>
				</tr>
				<tr>
					<td nowrap align="center">
					<br>
						{{ html()->submit('ログイン') }}
					</td>
				</tr>
			</table>
			{{ html()->form()->close() }}
		</td>
	</tr>
</table>

</x-admin_guest-layout>
