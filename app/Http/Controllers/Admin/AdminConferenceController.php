<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;

class AdminConferenceController extends Controller
{
    private function authorizeAdmin()
    {
        if (!auth()->user() || !auth()->user()->hasRole('Admin')) {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $this->authorizeAdmin();
        $conferences = Conference::all();
        return view('admin.conferences.index', compact('conferences'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.conferences.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

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

        return redirect()->route('admin.conferences.index')->with('success', 'Conference created successfully.');
    }

    public function edit(Conference $conference)
    {
        $this->authorizeAdmin();
        return view('admin.conferences.edit', compact('conference'));
    }

    public function update(Request $request, Conference $conference)
    {
        $this->authorizeAdmin();

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
    $this->authorizeAdmin();
    $conference->delete();

    return redirect()->back()->with('success', 'Conference deleted successfully.');
}
}
