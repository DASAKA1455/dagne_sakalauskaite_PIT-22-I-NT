<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;

class AdminConferenceController extends Controller
{
    public function create()
    {
        if (!auth()->user() || !auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        return view('admin.conferences.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user() || !auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Conference::create($request->all());

        return redirect()->route('conferences.index')->with('success', 'Conference created successfully.');
    }
}
