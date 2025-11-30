@extends('layouts.app')

@section('title', 'Sign In: ' . $conference->title)

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow text-gray-800">
    <h1 class="text-3xl font-bold mb-6">Sign in for: {{ $conference->title }}</h1>

    <p class="mb-4"><strong>Date:</strong> {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
    <p class="mb-4"><strong>Location:</strong> {{ $conference->location ?? 'TBA' }}</p>

    <form action="{{ route('conferences.signin', $conference) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="notes" class="block font-semibold mb-1">Optional notes</label>
            <textarea name="notes" id="notes" rows="3" class="w-full border p-2 rounded"></textarea>
        </div>

        <button type="submit" 
                class="bg-accent text-white px-6 py-3 rounded hover:bg-primary transition">
            Sign In
        </button>
    </form>

    <a href="{{ route('home') }}" class="inline-block mt-4 text-accent hover:underline">Back to Conferences</a>
</div>
@endsection
