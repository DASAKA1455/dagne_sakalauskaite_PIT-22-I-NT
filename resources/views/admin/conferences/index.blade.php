@extends('layouts.app')

@section('title', __('All Conferences'))

@section('content')
<h2 class="text-2xl font-semibold mb-4">{{ __('All conferences') }}</h2>

<a href="{{ route('admin.conferences.create') }}" class="bg-accent text-white px-4 py-2 rounded hover:bg-primary transition mb-4 inline-block">
    {{ __('Add conference') }}
</a>

<table class="w-full border-collapse border border-gray-200">
    <thead>
        <tr>
            <th class="border px-4 py-2">#</th>
            <th class="border px-4 py-2">{{ __('Title') }}</th>
            <th class="border px-4 py-2">{{ __('Date') }}</th>
            <th class="border px-4 py-2">{{ __('Location') }}</th>
            <th class="border px-4 py-2">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($conferences as $conference)
            <tr>
                <td class="border px-4 py-2">{{ $conference->id }}</td>
                <td class="border px-4 py-2">{{ $conference->title }}</td>
                <td class="border px-4 py-2">{{ $conference->date }}</td>
                <td class="border px-4 py-2">{{ $conference->location }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.conferences.edit', $conference->id) }}" class="bg-accent text-white px-3 py-1 rounded hover:bg-primary transition mr-2">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('admin.conferences.destroy', $conference->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition"
                                onclick="return confirm('Are you sure?')">
                            {{ __('Delete') }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
