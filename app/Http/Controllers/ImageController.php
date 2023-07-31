<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function index(Request $request, $id)
    {
        return view('image.index', compact([$id => 'id']));
        // return compact([$id =>"id"]);
    }

    // Update Image File
    public function update(Request $request, $id)
    {
    }
}
