@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-4xl mx-auto bg-surface p-8 rounded-xl shadow text-textPrimary">
    <h1 class="text-4xl font-bold mb-10 text-center">{{ __('Dashboard') }}</h1>
    <div class="mb-10 bg-background p-6 rounded-lg shadow">
        <h2 class="text-2xl font-semibold mb-4 text-primary">{{ __('Your information') }}</h2>

        <div class="space-y-2 text-black">
            <p><span class="font-semibold text-black">{{ __('Name:') }}</span> {{ auth()->user()->name }}</p>
            <p><span class="font-semibold text-black">{{ __('Email:') }}</span> {{ auth()->user()->email }}</p>
            <p>
                <span class="font-semibold text-surface">{{ __('Role:') }}</span>
                <span class="italic text-surface">Coming soon…</span>
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
            <a href="{{ route('profile.edit') }}#email"
               class="text-center bg-accent text-background px-4 py-3 rounded-lg shadow hover:bg-primary transition">
                Change Email
            </a>
            <a href="{{ route('profile.edit') }}#password"
               class="text-center bg-primary text-white px-4 py-3 rounded-lg shadow hover:bg-accent transition">
                Change Password
            </a>
        </div>
    </div>
    <h2 class="text-2xl font-semibold mb-4 text-white">{{ __('Your conferences') }}</h2>
    @if ($conferences->isEmpty())
        <p class="mb-6 text-textSecondary"></p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($conferences as $conference)
                <div class="group relative bg-background rounded-lg shadow p-6 hover:shadow-2xl transition transform hover:scale-105">

                    <div class="mb-4">
                        <h4 class="text-xl font-semibold text-primary mb-2">{{ $conference->title }}</h4>
                        <p class="text-textSecondary"><strong>Date:</strong> {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
                        <p class="text-textSecondary"><strong>Location:</strong> {{ $conference->location ?? 'TBA' }}</p>
                    </div>

                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 
                                group-hover:opacity-100 flex items-center justify-center 
                                transition duration-300 rounded-lg">
                        <a href="{{ route('conferences.show', $conference->id) }}" 
                           class="bg-accent text-background px-4 py-2 rounded hover:bg-primary transition scale-0 group-hover:scale-100">
                            Details
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

@endsection
