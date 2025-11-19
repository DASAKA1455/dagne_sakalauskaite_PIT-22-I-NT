<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * Skelbimas
     */
    public function index()
    {
        $conferences = Conference::all();
        return view('conferences.index', compact('conferences'));
    }
    public function show($id)
    {
        $conference = Conference::findOrFail($id);
        $user = auth()->user();
        $signedIn = $user->conferences->contains($conference->id);

        return view('conferences.show', compact('conference', 'signedIn'));
    }
    public function signin(Request $request, $id)
    {
        $conference = Conference::findOrFail($id);
        $user = auth()->user();
        if (!$user->conferences->contains($conference->id)) {
            $user->conferences()->attach($conference->id);
        }
        return redirect()->route('conferences.show', $conference->id)
                         ->with('success', 'You have successfully signed into the conference.');
    }
}
