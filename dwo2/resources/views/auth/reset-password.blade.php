<x-guest-layout>
<style>
ul {
  list-style: none;
}
</style>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

<br>

		<table class="new"  border="1" cellspacing="0" frame="hsides" rules="rows">
		<tr>
			<td width="120">ログインID</td>
			<td>
				{{ html()->text('profile_cust_code' ,$request->profile_cust_code)->attribute('maxlength', '20') }}
			</td>
		</tr>
		<tr>
			<td width="120">{{ __('Email') }}</td>
			<td>
				<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" autofocus autocomplete="username" />
			</td>
		</tr>
		<tr>
			<td class="item">パスワード</td>
			<td>
				<x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
			</td>
		</tr>
		<tr>
			<td class="item">パスワードを再入力</td>
			<td>
				<x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" autocomplete="new-password" />
			</td>
		</tr>
		</table>
		<div style="font-size: 14px; color:red;">
			パスワード（半角英数字記号8～64文字、英字の大文字小文字は区別されます。）
		</div>
		<br>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
