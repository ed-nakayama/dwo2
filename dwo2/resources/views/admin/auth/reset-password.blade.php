<x-admin_guest-layout>

<style>
/* テーブル背景 */
table{
	font-size : 12px;
	margin-top : 0px;
	margin-bottom : 0px;
/*	word-break : break-all; 2019/09/17 mikami */
	}

/* テーブルの左端の間隔 */
td{
	padding-left : 3px;
	}

/* 入力フォームのテーブルの高さ */
table.new td{
	height : 40px;
	}

td.item {
	background-color : #efffef;
	padding-left : 3px;
	white-space : nowrap;
	}

</style>

@foreach ($errors->all() as $error)
	<li style="list-style:none; color:red;">{{ $error }}</li>
@endforeach

    <form method="POST" action="{{ route('admin.password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

<br>
		<table class="new"  border="1" cellspacing="0" frame="hsides" rules="rows">
		<tr>
			<td width="120">オペレータID</td>
			<td>
				{{ html()->text('operator_id' ,$request->operator_id)->attribute('maxlength', '20') }}
			</td>
		</tr>
		<tr>
			<td width="120">{{ __('Email') }}</td>
			<td>
				<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
			</td>
		</tr>
		<tr>
			<td>パスワード</td>
			<td>
				<x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
			</td>
		</tr>
		<tr>
			<td>パスワードを再入力</td>
			<td>
				<x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
			</td>
		</tr>
		</table>

<br>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

</x-admin_guest-layout>
