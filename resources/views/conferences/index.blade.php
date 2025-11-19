@extends('layouts.app')

@section('title', 'Upcoming Conferences')

@section('content')

<h2 class="text-3xl font-semibold mb-8 text-center text-gray-800">Upcoming Conferences</h2>

@if($conferences->isEmpty())
    <p class="text-center text-gray-600">No conferences available at the moment.</p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach($conferences as $conference)
            <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between hover:shadow-2xl transition">
                <div>
                    <h3 class="text-xl font-bold mb-3 text-blue-700">{{ $conference->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ Str::limit($conference->description, 120, '...') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-4">Date: {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
                    <a href="{{ route('conferences.show', $conference->id) }}" class="block w-full text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                        View Details
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
