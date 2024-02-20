<x-admin_guest-layout>

<style>
ul {
  list-style: none;
}
</style>

<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
	{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<br>

<!-- Session Status -->
<font color="blue">
	<x-auth-session-status class="mb-4" :status="session('status')" />
</font>
@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

{{ html()->form('POST', route('admin.password.email'))->open() }}
	<table>
		<tr>
			<td>オペレータID</td>
			<td>
				{{ html()->text('operator_id')->attribute('maxlength', '20') }}
			</td>
		</tr>

		<tr>
			<td>メールアドレス</td>
			<td>
				{{ html()->text('email')->attribute('maxlength', '80') }}
			</td>
		</tr>
	</table>
	
<br>
{{ html()->submit(__('Email Password Reset Link')) }}

{{ html()->form()->close() }}

</x-admin_guest-layout>
