@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-4xl mx-auto bg-surface p-8 rounded-xl shadow text-textPrimary">
    <h1 class="text-4xl font-bold mb-10 text-center">{{ __('Dashboard') }}</h1>

    <div class="mb-10 bg-background p-6 rounded-lg shadow">

        @can('viewAny', \App\Models\User::class)
        <div class="mb-6 flex justify-end">
            <a href="{{ route('admin.users.index') }}"
               class="text-center bg-accent text-white px-4 py-3 rounded-lg shadow hover:bg-primary transition">
                {{ __('Manage users') }}
            </a>
        </div>
        @endcan

        @if (Gate::allows('manageConferences'))
        <div class="mb-6 flex justify-end space-x-4">
            <a href="{{ route('admin.conferences.index') }}"
               class="text-center bg-accent text-white px-4 py-3 rounded-lg shadow hover:bg-primary transition">
               {{ __('Manage Conferences') }}
            </a>
            <a href="{{ route('admin.conferences.create') }}"
               class="text-center bg-accent text-white px-4 py-3 rounded-lg shadow hover:bg-primary transition">
               {{ __('Create Conference') }}
            </a>
        </div>
        @endif

        <h2 class="text-2xl font-semibold mb-4 text-primary">{{ __('Your information') }}</h2>
        <div class="space-y-2 text-black">
            <p><span class="font-semibold">{{ __('Name:') }}</span> {{ auth()->user()->name }}</p>
            <p><span class="font-semibold">{{ __('Email:') }}</span> {{ auth()->user()->email }}</p>
            <p>
                <span class="font-semibold">{{ __('Role:') }}</span>
                <span class="italic">
                    {{ implode(', ', auth()->user()->getRoleNames()->map(fn($role) => __($role))->toArray()) }}
                </span>
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
            <a href="{{ route('profile.edit') }}#email"
               class="text-center bg-accent text-white px-4 py-3 rounded-lg shadow hover:bg-primary transition duration-300 ease-in-out scroll-smooth">
                {{ __('Change email') }}
            </a>
            <a href="{{ route('profile.edit') }}#password"
               class="text-center bg-accent text-white px-4 py-3 rounded-lg shadow hover:bg-primary transition duration-300 ease-in-out scroll-smooth">
                {{ __('Change password') }}
            </a>
        </div>
    </div>

    <h2 id="my-conferences" class="text-2xl font-semibold mb-4 text-white">{{ __('Your conferences') }}</h2>
    @if ($conferences->isEmpty())
        <p class="mb-6 text-textSecondary">{{ __('You are not registered for any conferences.') }}</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($conferences as $conference)
                <div class="group relative bg-background rounded-lg shadow p-6 hover:shadow-2xl transition transform hover:scale-105">
                    <div class="mb-4">
                        <h4 class="text-xl font-semibold text-primary mb-2">{{ $conference->title }}</h4>
                        <p class="text-textSecondary"><strong>{{ __('Date:') }}</strong> {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
                        <p class="text-textSecondary"><strong>{{ __('Location:') }}</strong> {{ $conference->location ?? 'TBA' }}</p>
                    </div>

                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 
                                group-hover:opacity-100 flex items-center justify-center 
                                transition duration-300 rounded-lg">
                        <a href="{{ route('conferences.show', $conference->id) }}" 
                           class="bg-accent text-white px-4 py-2 rounded hover:bg-primary transition scale-0 group-hover:scale-100">
                            {{ __('Details') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
