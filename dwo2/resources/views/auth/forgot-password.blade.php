<x-guest-layout>

<style>
ul {
  list-style: none;
}
</style>

	<div>
		{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
	</div>
	<br>

    <!-- Session Status -->
	<div style="color:blue;">
		<x-auth-session-status class="mb-4" :status="session('status')" />
	</div>

	<form method="POST" action="{{ route('password.email') }}">
	@csrf

		<!-- Email Address -->
		<div>
			<x-input-label for="email" :value="__('Email')" />
			<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
			<div style="color:red">
				<x-input-error :messages="$errors->get('email')" class="mt-2" />
			</div>
		</div>
		<br>
		<div class="flex items-center justify-end mt-4">
			<x-primary-button>
				{{ __('Email Password Reset Link') }}
			</x-primary-button>
		</div>
	</form>

</x-guest-layout>
