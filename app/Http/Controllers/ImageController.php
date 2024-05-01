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

    public function uploadImage(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->store('public/images');

        return redirect('image-form')->with('status', 'Uploaded............');
    }
}
