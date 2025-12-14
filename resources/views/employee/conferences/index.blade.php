@extends('layouts.app')

@section('title', 'All Conferences')

@section('content')
<h1 class="text-3xl font-bold mb-6">All Conferences</h1>

@if($conferences->isEmpty())
    <p>No conferences available.</p>
@else
    <div class="space-y-6">
        @foreach($conferences as $conference)
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold">{{ $conference->title }}</h2>
                <p><strong>Date:</strong> {{ $conference->date }}</p>
                <p><strong>Location:</strong> {{ $conference->location }}</p>
                <p><strong>Registered Users:</strong></p>
                <ul class="list-disc list-inside">
                    @forelse($conference->users as $user)
                        <li>{{ $user->name }} ({{ $user->email }})</li>
                    @empty
                        <li>No users registered yet.</li>
                    @endforelse
                </ul>
            </div>
        @endforeach
    </div>
@endif
@endsection
