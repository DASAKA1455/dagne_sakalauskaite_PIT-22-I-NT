@extends('layouts.app')

@section('title', $conference->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow text-gray-800">
    <div class="flex justify-between items-start mb-6">
        <h1 class="text-4xl font-bold">{{ $conference->title }}</h1>

        @auth
            @php
                $isRegistered = auth()->user()->conferences()->where('conference_id', $conference->id)->exists();
            @endphp

            @if($isRegistered)
                <button class="bg-gray-400 text-white border-2 border-gray-400 px-6 py-3 rounded cursor-not-allowed" disabled>
                    {{ __('Already registered') }}
                </button>
            @else
                <form action="{{ route('conferences.signin', $conference->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-white text-accent border-2 border-accent px-6 py-3 rounded 
                                   transition duration-300 ease-in-out
                                   hover:bg-accent hover:text-white hover:border-accent">
                        {{ __('Register') }}
                    </button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" 
               class="bg-white text-accent border-2 border-accent px-6 py-3 rounded 
                      transition duration-300 ease-in-out
                      hover:bg-accent hover:text-white hover:border-accent">
               {{ __('Login to register') }}
            </a>
        @endauth
    </div>

    @if($conference->thumbnail)
        <img src="{{ asset('storage/' . $conference->thumbnail) }}" 
             alt="{{ $conference->title }}" 
             class="w-full h-80 object-cover rounded mb-6">
    @endif

    <p class="text-lg mb-2"><strong>{{ __('Date') }}: </strong> {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
    <p class="text-lg mb-2"><strong>{{ __('Location') }}: </strong> {{ $conference->location ?? 'TBA' }}</p>

    @if($conference->description)
        <p class="text-gray-700 mt-4">{{ $conference->description }}</p>
    @endif

    <a href="{{ route('home') }}" 
       class="inline-block mt-6 bg-gray-200 text-gray-800 px-6 py-3 rounded hover:bg-gray-300 transition">
       {{ __('Go back') }}
    </a>
</div>
@endsection
