@extends('layout.app')

@section('content')

<h2 class="text-center">Search Results</h2>
<div class="container">
    <div class="card p-2 d-flex justify-content-between">
        @if($user)
        <p>Name: {{ucFirst($user->name)}} </p> 
        <a href="{{route('addFriend',$user->id)}}" class="btn btn-primary">Add Friend</a>
        @else
        <p>Sorry! NO such user found</p>
        @endif
    </div>
</div>


@endsection