<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;

class PVController extends Controller
{
    public function showPost($id)
    {
        $post = Post::with('image')->find($id);
        return view('pv.show', compact('post'));
    }
    public function showVideo($id)
    {
        $video = Video::with('image')->find($id);
        return view('pv.show', compact('video'));
    }
}
