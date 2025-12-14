<form method="post" action="{{ route('user-password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div>
        <x-input-label for="current_password" :value="__('Current Password')" />
        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" required autocomplete="current-password" />
        <x-input-error class="mt-2" :messages="$errors->get('current_password')" />
    </div>

    <div>
        <x-input-label for="password" :value="__('New Password')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
        <x-input-error class="mt-2" :messages="$errors->get('password')" />
    </div>

    <div>
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" required autocomplete="new-password" />
    </div>

    <x-primary-button>{{ __('Change Password') }}</x-primary-button>
</form>
