<?php

use App\Models\Friend;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');


Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [UserController::class, 'loginUser'])->name('loginUser');


Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/signup', [UserController::class, 'signupUser'])->name('signupUser');

Route::get('/logout', [UserController::class, 'logoutUser'])->name('logout')->middleware('auth');

Route::post('/search-friend', [UserController::class, 'searchFriend'])->name('searchFriend')->middleware('auth');

//Send Friend Request
Route::get('/send-friend-req/{id}', [FriendRequestController::class, 'sendFriendRequest'])->name('sendFriendRequest')->middleware('auth');

//friend request accept
Route::get('/friend-request-accept/{id}', [FriendRequestController::class, 'AcceptFriendRequest'])->name('acceptFriendRequest')->middleware('auth');

//delete friend
Route::get('/delete-friend/{id}', [FriendController::class, 'deleteFriend'])->name('deleteFriend');

//Add Post
Route::post('/add-post', [PostController::class, 'addPost'])->name('addPost')->middleware('auth');

//Edit post
Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->name('editPost');
Route::post('/edit-post', [PostController::class, 'saveChangesToEditPost'])->name('saveChangesToEditPost');

//Delete post
Route::get('/delete-post/{id}', [PostController::class, 'deletePost'])->name('deletePost');