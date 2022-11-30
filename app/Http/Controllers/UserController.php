<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //for sign ups
    public function signupUser(Request $req)
    {

        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        User::create(['name' => $req->name, 'email' => $req->email, 'password' => Hash::make($req->password)]);

        return redirect()->route('login');
    }

    //to login users
    public function loginUser(Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($req->only('email', 'password'))) {
            return redirect()->route('dashboard');
        } else {
            return back()->with('fail', 'Email or Password is incorrect');
        }
    }

    //to signout users
    public function logoutUser()
    {
        AUth::logout();
        return redirect()->route('login');
    }

    //to search friend
    public function searchFriend(Request $req)
    {



        //friend request count
        $friendRequestCount = FriendRequest::where('user1_id', auth()->user()->id)->count();

        //friend request list
        $friendRequestIDs = FriendRequest::where('user1_id', auth()->user()->id);
        //to store the users
        $friendRequests = array();
        //getting corresponding value from user table
        foreach ($friendRequestIDs as $friendRequestID) {
            array_push($friendRequests, User::where('id', $friendRequestID->user2_id)->first());
        }


        $user = User::where('email', $req->email)->first();

        //friend request sent to searched user is false by default;
        $friendRequestSent = false;

        //friends with searched user is false by default
        $isAlreadyFriend = false;


        //if searched user is found
        if ($user) {


            //to check if friend request has already been sent
            $isPending1 = FriendRequest::where('user1_id', auth()->user()->id)->where('user2_id', $user->id)->first();
            $isPending2 = FriendRequest::where('user1_id', $user->id)->where('user2_id', auth()->user()->id)->first();


            //to check if already friends
            $isAlreadyFriend = Friend::where('user1_id', auth()->user()->id)->where('user2_id', $user->id)->first();
            if (!$isAlreadyFriend) {
                $isAlreadyFriend = Friend::where('user1_id', $user->id)->where('user2_id', auth()->user()->id)->first();
            }

            //get all friend requests


            if ($isPending1 || $isPending2) {
                $friendRequestSent = true;
            } else {
                $friendRequestSent = false;
            }
        }
        if (!$user || $user->id != auth()->user()->id) {
            return view('searchResult', compact('user', 'friendRequestSent', 'isAlreadyFriend', 'friendRequestCount', 'friendRequests'));
        } else {
            return redirect()->route('dashboard');
        }
    }
}