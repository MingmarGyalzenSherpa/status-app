@extends('layout.app')

@section('content')

<div class="row w-100" style="min-height: 80vh">
    <div class="col-4 border-end p-0">
        <h2 class=" p-3" style="font-size: 16px; box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;">Friends</h2>
        <div class="container ms-1">
            @if($friends)
                @foreach($friends as $friend)

                <div class="card mt-2 p-1 bg-dark bg-gradient text-white bg-opacity-25">
                  <p>{{ucFirst($friend->name)}}</p>
                </div>
                @endforeach
            @endif
        </div>
       

    </div>
    <div class="col-8  p-0">
        <h2 class=" p-2" style="box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;">Feeds</h2>
        <div class="container">
            <form action="{{route('addPost')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Something in mind?" name="status"></textarea>
                  </div>
                <button type="submit" class="btn btn-primary">POST</button>
            </form>
            <hr>
            @foreach($statuses as $status)
            <div class="status card mt-2">
                <div class="card-body">
                    <h5 class="card-title">{{$status->user->name}}</h5>
                    <p class="card-text">{{$status->status}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
  </div>

@endsection