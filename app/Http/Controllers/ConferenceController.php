<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conference;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::all();
        return view('conferences.index', compact('conferences'));
    }

    public function show(Conference $conference)
    {
        return view('conferences.show', compact('conference'));
         $user = auth()->user();
        $isRegistered = false;

    if ($user) {
        $isRegistered = $user->conferences()->where('conference_id', $conference->id)->exists();
    }

    return view('conferences.show', compact('conference', 'isRegistered'));
    }

    public function showSigninForm(Conference $conference)
    {
        return view('conferences.signin', compact('conference'));
    }
    public function signin(Request $request, Conference $conference)
    {
        $user = $request->user();
        $user->conferences()->syncWithoutDetaching($conference->id);

        return redirect()->route('dashboard')
                         ->with('success', 'You have signed up for the conference!');
    }
}
