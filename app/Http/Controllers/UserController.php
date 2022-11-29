<?php

namespace App\Http\Controllers;


use App\Models\User;
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

        $user = User::where('email', $req->email)->first();
        if (!$user || $user->id != auth()->user()->id) {
            return view('searchResult', compact('user'));
        } else {
            return redirect()->route('dashboard');
        }
    }
}