@extends('layouts.app')

@section('title', __('Upcoming Conferences'))

@section('content')

<h2 class="text-3xl font-semibold mb-8 text-left text-gray-800">
    {{ __('Upcoming Conferences') }}
</h2>

@auth
    @if(auth()->user()->hasAnyRole(['Admin', 'Employee']))
        <div class="text-right mb-6">
            <a href="{{ route('admin.conferences.create') }}"
               class="bg-accent text-white px-6 py-3 rounded hover:bg-primary transition m-2">
                {{ __('Add conference') }}
            </a>
        </div>
    @endif
@endauth

@if($conferences->isEmpty())
    <p class="text-left text-gray-600">
        {{ __('No conferences available.') }}
    </p>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($conferences as $conference)
            <div class="bg-white shadow-lg rounded-lg p-4 flex flex-col justify-between hover:shadow-2xl transition">
                <div class="mb-4">
                 @if($conference->thumbnail)
                        <a href="{{ route('conferences.show', $conference->id) }}">
                            <img src="{{ asset('storage/' . $conference->thumbnail) }}" alt="{{ $conference->title }}"
                                class="h-60 w-full object-cover rounded mb-3 hover:opacity-65 transition">
                        </a>
                    @else
                        <a href="{{ route('conferences.show', $conference->id) }}">
                            <div class="h-60 w-full bg-gray-200 rounded mb-3 hover:opacity-90 transition"></div>
                        </a>
                    @endif

                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $conference->title }}</h3>
                    <p class="text-sm text-gray-500">{{ __('Date') }}: {{ \Carbon\Carbon::parse($conference->date)->format('F j, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ __('Location') }}: {{ $conference->location }}</p>
                </div>

                <div class="flex flex-col space-y-1">
                    <div class="flex justify-end -mb-1">
                        <a href="{{ route('conferences.show', $conference->id) }}"
                           class="bg-accent text-white px-3 py-1 rounded hover:bg-primary transition">
                            {{ __('View more') }}
                        </a>
                    </div>
                    @auth
                        @if(auth()->user()->hasRole('Employee'))
                            <div class="flex justify-end mt-2">
                                <a href="{{ route('employee.conferences.users', $conference->id) }}"
                                class="bg-accent text-white px-3 py-1 rounded hover:bg-primary transition">
                                    {{ __('Show list') }}
                                </a>
                            </div>
                        @endif
                    @endauth

                    @auth
                        @if(auth()->user()->hasRole('Admin'))
                            <div class="flex justify-end items-center space-x-1">
                                <a href="{{ route('admin.conferences.edit', $conference->id) }}"
                                   class="bg-accent text-white px-3 py-1 rounded hover:bg-primary transition">
                                    {{ __('Edit') }}
                                </a>

                                <form action="{{ route('admin.conferences.destroy', $conference->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-white text-black border px-3 py-1 rounded hover:bg-red-700 transition"
                                            onclick="return confirm('Are you sure you want to delete this conference?')">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
