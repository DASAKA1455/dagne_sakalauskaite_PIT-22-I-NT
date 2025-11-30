<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $conferences = $user->conferences()
        ->orderBy('date', 'asc') // sort by ascending date
        ->get();

    return view('dashboard', compact('conferences'));
}
}
