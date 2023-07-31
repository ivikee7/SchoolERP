<?php

namespace App\Http\Controllers;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('profile')->with(['user' => auth()->user()]);
    }
}
