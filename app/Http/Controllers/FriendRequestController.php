<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    //send friend request
    public function sendFriendRequest($id)
    {

        //to check if friend request has already been sent
        $isPending1 = FriendRequest::where('user1_id', auth()->user()->id)->where('user2_id', $id)->first();
        $isPending2 = FriendRequest::where('user1_id', $id)->where('user2_id', auth()->user()->id)->first();

        if (!$isPending1 && !$isPending2) {

            //logged in user's id gets stored in user2
            FriendRequest::create([
                'user1_id' => $id,
                'user2_id' => auth()->user()->id,
            ]);
        }


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


        return view('friendRequestSent', compact('friendRequestCount', 'friendRequests'));
    }

    public function acceptFriendRequest($id)
    {
        //1.Insert into friends table
        Friend::create([
            'user1_id' => $id,
            'user2_id' => auth()->user()->id,
        ]);


        //delete from friend request table

        //Note:
        //1. user1_id contains our id
        //2. user2_id contains id of the one who sent friend request
        $data = FriendRequest::where('user1_id', auth()->user()->id)->where('user2_id', $id)->first();
        $data->delete();
        return redirect()->route('dashboard');
    }

    public function denyFriendRequest($id)
    {


        //1.Delete from friend request data
        $data = FriendRequest::where('user1_id', auth()->user()->id)->where('user2_id', $id)->first();
        $data->delete();
        return redirect('dashboard');
    }
}