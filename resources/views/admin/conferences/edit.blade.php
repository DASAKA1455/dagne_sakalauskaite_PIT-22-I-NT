@extends('layouts.app')

@section('title', 'Edit Conference')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow text-gray-800">
    <h1 class="text-3xl font-bold mb-6">{{ __('Edit conference') }}</h1>

    <form action="{{ route('admin.conferences.update', $conference->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-semibold mb-1">{{ __('Title') }}</label>
            <input type="text" name="title" id="title" value="{{ old('title', $conference->title) }}"
                   class="w-full border border-gray-300 p-2 rounded">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="date" class="block font-semibold mb-1">{{ __('Date') }}</label>
            <input type="date" name="date" id="date" value="{{ old('date', $conference->date) }}"
                   class="w-full border border-gray-300 p-2 rounded">
            @error('date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="location" class="block font-semibold mb-1">{{ __('Location') }}</label>
            <input type="text" name="location" id="location" value="{{ old('location', $conference->location) }}"
                   class="w-full border border-gray-300 p-2 rounded">
            @error('location')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block font-semibold mb-1">{{ __('Description') }}</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 p-2 rounded">{{ old('description', $conference->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="thumbnail" class="block font-semibold mb-1">{{ __('Thumbnail') }}</label>
            @if($conference->thumbnail)
                <img src="{{ asset('storage/' . $conference->thumbnail) }}" alt="{{ $conference->title }}" class="w-64 h-40 object-cover mb-2 rounded">
            @endif
            <input type="file" name="thumbnail" id="thumbnail" class="w-full">
            @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.conferences.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">{{ __('Cancel') }}</a>
            <button type="submit" class="px-4 py-2 bg-accent text-white rounded hover:bg-primary">{{ __('Update') }}</button>
        </div>
    </form>
</div>
@endsection
