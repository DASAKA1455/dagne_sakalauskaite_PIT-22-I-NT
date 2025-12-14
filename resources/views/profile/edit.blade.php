@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('content')
<div class="max-w-4xl mx-auto bg-surface p-8 rounded-xl shadow text-textPrimary">
    <h1 class="text-4xl font-bold mb-10 text-center text-white">{{ __('Edit profile') }}</h1>

    @if(session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-green-500 text-white rounded-lg">
            {{ __('Profile updated successfully.') }}
        </div>
    @elseif(session('status') === 'password-updated')
        <div class="mb-6 p-4 bg-green-500 text-white rounded-lg">
            {{ __('Password updated successfully.') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div>
            <h2 id="email" class="text-2xl font-semibold mb-4 text-white">{{ __('Change email') }}</h2>
            <form method="POST" action="{{ route('user-profile-information.update') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="email" class="block mb-1 font-semibold text-white">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           class="w-full p-3 rounded-lg border border-gray-300 text-black focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg shadow hover:bg-primary transition">
                    {{ __('Update email') }}
                </button>
            </form>
        </div>

        <div>
            <h2 id="password" class="text-2xl font-semibold mb-4 text-white">{{ __('Change password') }}</h2>
            <form method="POST" action="{{ route('user-password.update') }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="current_password" class="block mb-1 font-semibold text-white">{{ __('Current password') }}</label>
                    <input type="password" name="current_password" id="current_password" placeholder="{{ __('Current password') }}" required
                           class="w-full p-3 rounded-lg border border-gray-300 text-black focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block mb-1 font-semibold text-white">{{ __('New password') }}</label>
                    <input type="password" name="password" id="password" placeholder="{{ __('New password') }}" required
                           class="w-full p-3 rounded-lg border border-gray-300 text-black focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block mb-1 font-semibold text-white">{{ __('Confirm password') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('Confirm password') }}" required
                           class="w-full p-3 rounded-lg border border-gray-300 text-black focus:outline-none focus:ring-2 focus:ring-accent focus:border-accent">
                </div>
                <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg shadow hover:bg-primary transition">
                    {{ __('Update password') }}
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
