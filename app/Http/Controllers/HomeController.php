<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use App\Models\Post;

class HomeController extends Controller
{
    //
    public function dashboard()
    {

        $data = Friend::where('user1_id', auth()->user()->id)->orWhere('user2_id', auth()->user()->id)->get();
        $friends = array();
        //get all friends
        foreach ($data as $friend) {
            if ($friend->user1_id == auth()->user()->id) {

                array_push($friends, User::where('id', $friend->user2_id)->first());
            } else {
                array_push($friends, User::where('id', $friend->user1_id)->first());
            }
        }

        $statuses = array();
        //get all the post
        $posts = Post::all();
        foreach ($friends as $friend) {
            foreach ($posts as $post) {
                if ($post->user->id == $friend->id) {
                    array_push($statuses, $post);
                }
            }
        }

        //get all friend requests

        //friend request count
        $friendRequestCount = FriendRequest::where('user1_id', auth()->user()->id)->count();

        //friend request list with id
        $friendRequestIDs = FriendRequest::where('user1_id', auth()->user()->id)->get();

        //to store the users
        $friendRequests = array();
        //getting corresponding value from user table
        foreach ($friendRequestIDs as $friendRequestID) {
            array_push($friendRequests, User::where('id', $friendRequestID->user2_id)->first());
        }


        return view('dashboard', compact('friends', 'statuses', 'friendRequestCount', 'friendRequests'));
    }
}