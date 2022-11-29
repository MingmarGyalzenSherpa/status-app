<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function addPost(Request $req)
    {
        Post::create([
            'status' => $req->status,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('dashboard');
    }
}