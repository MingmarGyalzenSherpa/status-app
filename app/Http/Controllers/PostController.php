<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\FriendRequest;

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

    //delete post
    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('dashboard');
    }

    public function editPost($id)
    {
        $post = Post::find($id);


        //get all friend requests
        //friend request count
        $friendRequestCount = FriendRequest::where('user1_id', auth()->user()->id)->count();

        //friend request list
        $friendRequestIDs = FriendRequest::where('user1_id', auth()->user()->id)->get();
        //to store the users
        $friendRequests = array();
        //getting corresponding value from user table
        foreach ($friendRequestIDs as $friendRequestID) {
            array_push($friendRequests, User::where('id', $friendRequestID->user2_id)->first());
        }

        return view('editPost', compact('post', 'friendRequestCount', 'friendRequests'));
    }

    //save changes to edit post
    public function saveChangesToEditPost(Request $req)
    {
        $post = Post::find($req->id);
        $post->status = $req->status;
        $post->save();
        return redirect()->route('dashboard');
    }
}