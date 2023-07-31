<?php

namespace App\Http\Controllers;

use App\Models\Media;

class VideoController extends Controller
{
    public function K2()
    {
        if (auth()->user()->can('media_access')) {
            $data = Media::all();

            return view('video.index', ['videos' => $data]);
        } else {
            return abort(404);
        }
    }
}
