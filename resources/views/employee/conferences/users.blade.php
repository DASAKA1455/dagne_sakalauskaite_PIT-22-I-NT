@extends('layouts.app')

@section('title', 'Registered users for ' . $conference->title)

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-surface rounded-xl shadow">
    <h1 class="text-4xl font-bold mb-6 text-center text-white">
        {{ __('Registered users for') }} "{{ $conference->title }}"
    </h1>

    @if($users->isEmpty())
        <p class="text-gray-200">{{ __('No users registered for this conference.') }}</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">{{ __('ID') }}</th>
                    <th class="p-2 border">{{ __('Name') }}</th>
                    <th class="p-2 border">{{ __('Email') }}</th>
                    <th class="p-2 border">{{ __('Role') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="text-center border text-white">
                        <td class="p-2 border">{{ $user->id }}</td>
                        <td class="p-2 border">{{ $user->name }}</td>
                        <td class="p-2 border">{{ $user->email }}</td>
                        <td class="p-2 border text-red">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
