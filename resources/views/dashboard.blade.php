@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-3xl mx-auto bg-surface p-8 rounded shadow text-textPrimary">
    <h2 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->name }}!</h2>
    <p class="mb-4">This is your user panel. Here you can view your profile and manage your conference sign-ins.</p>

    @if ($conferences->isEmpty())
        <p class="mb-6">You are not signed into any conferences yet.</p>
    @else
        <h3 class="text-2xl font-semibold mb-4">Your Signed-in Conferences</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @foreach($conferences as $conference)
                <div class="group relative bg-background rounded-lg shadow p-6 hover:shadow-2xl transition transform hover:scale-105">
                    <div class="mb-4">
                        <h4 class="text-xl font-semibold text-primary mb-2">{{ $conference->title }}</h4>
                        <p class="text-textSecondary"><strong>Date:</strong> {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
                        <p class="text-textSecondary"><strong>Location:</strong> {{ $conference->location ?? 'TBA' }}</p>
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-300 rounded-lg">
                        <a href="{{ route('conferences.show', $conference->id) }}" 
                           class="bg-accent text-background px-4 py-2 rounded hover:bg-primary transition scale-0 group-hover:scale-100">
                            Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('profile.edit') }}" class="inline-block bg-accent text-white px-4 py-2 rounded hover:bg-primary transition mt-6">
        Edit Profile
    </a>
</div>
@endsection
