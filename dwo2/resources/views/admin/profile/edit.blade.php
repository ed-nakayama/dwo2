<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Admin {{ __('Profile') }}
        </h2>
    </x-slot>

{{--  �᡼�륢�ɥ쥹 --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

{{--  �ѥ�����ѹ� --}}
			<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
				<div class="max-w-xl">
					<section>
						<header>
							<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
								{{ __('Update Password') }}
							</h2>
						</header>

						<form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
							@csrf
							@method('put')

							<div>
								<x-input-label for="current_password" :value="__('Current Password')" />
								<x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
								<x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
							</div>

							<div>
								<x-input-label for="password" :value="__('New Password')" />
								<x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
								<x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
							</div>

							<div>
								<x-input-label for="password_confirmation" :value="__('Confirm Password')" />
								<x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
								<x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
							</div>

							<div class="flex items-center gap-4">
								<x-primary-button>{{ __('Save') }}</x-primary-button>

								@if (session('status') === 'password-updated')
									<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"  class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
								@endif
							</div>
						</form>
					</section>
				</div>
			</div>

        </div>
    </div>
</x-admin-layout>