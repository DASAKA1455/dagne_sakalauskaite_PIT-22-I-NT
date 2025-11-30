<?php

namespace App\Http\Controllers;

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
    }
}
