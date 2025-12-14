<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;

class AdminConferenceController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Conference::class);

        $conferences = Conference::all();
        return view('admin.conferences.index', compact('conferences'));
    }

    public function create()
    {
        $this->authorize('create', Conference::class);

        return view('admin.conferences.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Conference::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('conferences', 'public');
        }

        Conference::create($data);

        // Redirect differently for Employees vs Admins
        if (auth()->user()->hasRole('Employee')) {
            return redirect()->route('dashboard')->with('success', 'Conference created successfully.');
        }

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully.');
    }

    public function edit(Conference $conference)
    {
        $this->authorize('update', $conference);

        return view('admin.conferences.edit', compact('conference'));
    }

    public function update(Request $request, Conference $conference)
    {
        $this->authorize('update', $conference);

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('conferences', 'public');
        }

        $conference->update($data);

        return redirect()->route('admin.conferences.index')->with('success', 'Conference updated successfully.');
    }

    public function destroy(Conference $conference)
    {
        $this->authorize('delete', $conference);

        $conference->delete();

        return redirect()->back()->with('success', 'Conference deleted successfully.');
    }
}
