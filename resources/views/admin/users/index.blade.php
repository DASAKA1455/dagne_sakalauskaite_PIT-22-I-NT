@extends('layouts.app')

@section('title', 'Manage users')

@section('content')
<div class="max-w-5xl mx-auto p-8 bg-surface rounded-xl shadow">
    <h1 class="text-4xl font-bold mb-6 text-center text-white ">{{ __('Users') }}</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">{{ __('ID') }}: </th>
                <th class="p-2 border">{{ __('Name') }}: </th>
                <th class="p-2 border">{{ __('Email') }}: </th>
                <th class="p-2 border">{{ __('Role') }}: </th>
                <th class="p-2 border">{{ __('Action') }}: </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="text-center border text-white ">
                    <td class="p-2 border">{{ $user->id }}</td>
                    <td class="p-2 border">{{ $user->name }}</td>
                    <td class="p-2 border">{{ $user->email }}</td>
                    <td class="p-2 border text-black ">
                        <form action="{{ route('admin.users.assignRole', $user) }}" method="POST">
                            @csrf
                            <select name="role" class="border rounded p-1">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                    </td>
                    <td class="p-2 border">
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-900">
                                {{ __('Change role') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
