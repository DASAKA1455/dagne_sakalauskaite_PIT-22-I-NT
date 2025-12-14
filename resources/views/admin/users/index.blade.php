@extends('layouts.app')

@section('title', 'Manage users')

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-surface rounded-xl shadow">
    <h1 class="text-4xl font-bold mb-6 text-center text-white">{{ __('Users') }}</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">{{ __('ID') }}</th>
                <th class="p-2 border">{{ __('Name') }}</th>
                <th class="p-2 border">{{ __('Email') }}</th>
                <th class="p-2 border">{{ __('Role') }}</th>
                <th class="p-2 border">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="text-center border text-white">
                    <td class="p-2 border">{{ $user->id }}</td>
                    <td class="p-2 border">
                        <input form="update-user-{{ $user->id }}" type="text" name="name" value="{{ $user->name }}" class="border rounded p-1 text-black w-full" required>
                    </td>
                    <td class="p-2 border">
                        <input form="update-user-{{ $user->id }}" type="email" name="email" value="{{ $user->email }}" class="border rounded p-1 text-black w-full" required>
                    </td>
                    <td class="p-2 border text-black">
                        <select form="update-user-{{ $user->id }}" name="role" class="border rounded p-1 w-full">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-2 border flex space-x-2 justify-center">
                        <form id="update-user-{{ $user->id }}" action="{{ route('admin.users.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-primary text-white px-3 py-1 rounded hover:bg-secondary">
                                {{ __('Update') }}
                            </button>
                        </form>

                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-900">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
