@extends('layouts.app')

@section('title', isset($conference) ? 'Edit Conference' : 'Create Conference')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-surface rounded-xl shadow">
    <h1 class="text-3xl font-bold mb-6">{{ isset($conference) ? 'Edit Conference' : 'Create Conference' }}</h1>

    <form method="POST" action="{{ isset($conference) ? route('admin.conferences.update', $conference) : route('admin.conferences.store') }}">
        @csrf
        @if(isset($conference))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title', $conference->title ?? '') }}"
                   class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border p-2 rounded">{{ old('description', $conference->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Date</label>
            <input type="date" name="date" value="{{ old('date', isset($conference) ? $conference->date->format('Y-m-d') : '') }}"
                   class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Location</label>
            <input type="text" name="location" value="{{ old('location', $conference->location ?? '') }}"
                   class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500 transition">
            {{ isset($conference) ? 'Update' : 'Create' }}
        </button>
    </form>
</div>
@endsection
