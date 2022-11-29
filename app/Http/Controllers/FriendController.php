<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;

class FriendController extends Controller
{
    //delete Friend
    public function deleteFriend($id)
    {

        $friends = Friend::where('user1_id', $id)->where('user2_id', auth()->user()->id)->first();
        if (!$friends) {
            $friends = Friend::where('user1_id', auth()->user()->id);
        }
        $friends->delete();
        return redirect()->route('dashboard');
    }
}