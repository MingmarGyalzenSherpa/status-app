@extends('layout.app')

@section('content')

<h2 class="text-center">Search Results</h2>
<div class="container">
    <div class="card p-2 d-flex justify-content-between">
        @if($user)
            <p>Name: {{ucFirst($user->name)}} </p> 
             @if($friendRequestSent)
                <a href="{{route('dashboard')}}" class="btn btn-danger">Friend Request Already Sent! Go Back</a>
            @elseif($isAlreadyFriend)
            <a href="{{route('dashboard')}}" class="btn btn-primary">Already Friends with this Persong! Go Back</a>
            @else
            <a href="{{route('sendFriendRequest',$user->id)}}" class="btn btn-primary">
                Add Friend
                </a>
            
            @endif
        @else
        <p>Sorry! NO such user found</p>
        @endif
    </div>
</div>


@endsection