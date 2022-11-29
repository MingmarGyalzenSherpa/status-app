<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;

class FriendController extends Controller
{
    //

    public function dashboard()
    {

        $data = Friend::where('user1_id', auth()->user()->id)->orWhere('user2_id', auth()->user()->id)->get();
        $friends = array();
        foreach ($data as $friend) {
            if ($friend->user1_id == auth()->user()->id) {

                array_push($friends, User::where('id', $friend->user2_id)->first());
            } else {
                array_push($friends, User::where('id', $friend->user1_id)->first());
            }
        }
        // dd($friends);
        return view('dashboard', compact('friends'));
    }

    //to add friend
    public function addFriend($id)
    {
        Friend::create([
            'user1_id' => auth()->user()->id,
            'user2_id' => $id,
        ]);
        return redirect()->route('dashboard');
    }
}