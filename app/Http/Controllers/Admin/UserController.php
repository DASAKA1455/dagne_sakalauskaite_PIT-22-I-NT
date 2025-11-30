<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all(); 

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function assignRole(User $user, Request $request)
    {
        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')
                         ->with('success', "'{$request->role}' -> {$user->name}");
    }
}
