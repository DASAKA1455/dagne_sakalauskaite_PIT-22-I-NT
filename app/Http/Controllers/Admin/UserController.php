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
public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('admin.users.index')->with('success', "Deleted {$user->name}");
}

    public function update(User $user, Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|string|exists:roles,name',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $user->syncRoles([$request->role]);

    return redirect()->route('admin.users.index')
                     ->with('success', "Updated {$user->name}");
                     
}
}
