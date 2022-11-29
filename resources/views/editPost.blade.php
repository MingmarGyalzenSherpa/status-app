@extends('layout.app')
@section('content')
<div class="container w-50">

    <form action="{{route('saveChangesToEditPost')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$post->id}}">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label"></label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Something in mind?" name="status" >{{$post->status}}</textarea>
          </div>
        <button  type="submit" class="btn btn-primary">Edit</button>

    </form>
</div>
@endsection