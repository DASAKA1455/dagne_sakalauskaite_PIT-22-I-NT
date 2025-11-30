@extends('layouts.app')

@section('title', 'Manage Conferences')

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-surface rounded-xl shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manage Conferences</h1>
        <a href="{{ route('admin.conferences.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500 transition">
            Create Conference
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded">{{ session('success') }}</div>
    @endif

    @if($conferences->isEmpty())
        <p>No conferences available.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Location</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conferences as $conference)
                    <tr class="text-center border">
                        <td class="p-2 border">{{ $conference->title }}</td>
                        <td class="p-2 border">{{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</td>
                        <td class="p-2 border">{{ $conference->location ?? 'TBA' }}</td>
                        <td class="p-2 border flex justify-center gap-2">
                            <a href="{{ route('admin.conferences.edit', $conference) }}"
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-500">Edit</a>
                            <form action="{{ route('admin.conferences.destroy', $conference) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
