<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IDCardController extends Controller
{
    public function render($id)
    {
        $user = \App\Models\User::find($id);
        return view('id_card.print')->with(['user' => $user]);
    }
}
