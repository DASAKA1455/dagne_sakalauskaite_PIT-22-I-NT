<form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
    @csrf
    @method('delete')

    <div>
        <x-input-label for="password" :value="__('Confirm Password to Delete Account')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('password')" />
    </div>

    <x-primary-button class="bg-red-600 hover:bg-red-800">{{ __('Delete Account') }}</x-primary-button>
</form>
