@extends('layouts.app')

@section('title', __('Add Conference'))

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-semibold mb-4">{{ __('Add new conference') }}</h2>

    <form action="{{ route('admin.conferences.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="title">{{ __('Title') }}</label>
            <input type="text" name="title" id="title"
                   class="w-full border-gray-300 rounded px-3 py-2"
                   value="{{ old('title') }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="date">{{ __('Date') }}</label>
            <input type="date" name="date" id="date"
                   class="w-full border-gray-300 rounded px-3 py-2"
                   value="{{ old('date') }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="location">{{ __('Location') }}</label>
            <input type="text" name="location" id="location"
                   class="w-full border-gray-300 rounded px-3 py-2"
                   value="{{ old('location') }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium" for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="bg-accent text-white px-6 py-3 rounded hover:bg-primary transition m-2">
            {{ __('Create Conference') }}
        </button>
    </form>
</div>
@endsection
