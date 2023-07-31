<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    // Settings
    public function setttings(Request $request)
    {
        $user = User::find(Auth()->user()->id);

        $request->validate([
            'theme' => 'required',
        ]);

        $user = User::find(Auth()->user()->id);
        $user->settings = $request->theme;
        $user->save();
    }
}
