@extends('layouts.app')

@section('title', __('Upcoming Conferences'))

@section('content')

<h2 class="text-3xl font-semibold mb-8 text-left text-gray-800">
    {{ __('Upcoming Conferences') }}
</h2>
@auth
    @if(auth()->user()->hasRole('Admin'))
    <div class="text-right mb-6">
    <a href="{{ route('admin.conferences.create') }}"
       class="bg-accent text-white px-6 py-3 rounded hover:bg-primary transition m-2">
        {{ __('Add conference') }}
    </a>
        </div>
    @endif
@endauth

@php
    $conferences = [
        ['title' => 'Tech Summit 2025', 'date' => '2025-12-15', 'location' => 'New York, USA'],
        ['title' => 'AI Conference', 'date' => '2026-01-10', 'location' => 'San Francisco, USA'],
        ['title' => 'Web Dev Expo', 'date' => '2026-02-05', 'location' => 'London, UK'],
        ['title' => 'Cloud Computing Meetup', 'date' => '2026-03-20', 'location' => 'Berlin, Germany'],
    ];
@endphp

@if(empty($conferences))
    <p class="text-left text-gray-600">
        {{ __('No conferences available.') }}
    </p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($conferences as $conference)
            <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col justify-between hover:shadow-2xl transition">
                <div class="mb-4">
                    <div class="h-60 w-full bg-gray-200 rounded mb-3"></div> <!-- Thumbnail placeholder -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $conference['title'] }}</h3>
                    <p class="text-sm text-gray-500">{{ __('Date') }}: {{ \Carbon\Carbon::parse($conference['date'])->format('F j, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ __('Location') }}: {{ $conference['location'] }}</p>
                </div>

                <a href="#"
                   class="ml-auto w-max text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded transition">
                    {{ __('View More') }}
                </a>
            </div>
        @endforeach
    </div>
@endif

@endsection
