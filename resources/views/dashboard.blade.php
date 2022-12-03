@extends('layout.app')

@section('content')

<div class="row w-100" style="min-height: 80vh">
    <div class="col-4 border-end p-0">
        <div class="d-flex justify-content-between align-items-center p-3" style=" box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;">

            <span class=" " style="font-size: 16px;">FRIENDS </span>@if($friendsCount > 0) <span>  {{$friendsCount}} </span> @endif
        </div>
        <div class="container ms-1">
            @if($friends)
                @foreach($friends as $friend)

                <div class="border rounded d-flex align-items-center justify-content-between mt-2 p-2 ps-3 pe-3 bg-dark bg-gradient text-white bg-opacity-25">
                  <p class="mb-0" style="font-size:16px;">{{ucFirst($friend->name)}}</p>
                  <a href="{{route('deleteFriend',$friend->id)}}" class=""><i class="fas fa-trash" style="color:rgb(213, 64, 64);"> </i></a>
                </div>
                @endforeach
            @endif
        </div>
       

    </div>
    <div class="col-8  p-0">
        <h2 class=" p-2" style="box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;">Feeds</h2>
        <div class="container">
            <form action="{{route('addPost')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" placeholder="Something in mind?" name="status"></textarea>
                  </div>
                  <div class="mb-3 border pt-1 ps-3 pe-3 w-100 rounded d-flex justify-content-between " style="font-size:18px;">
                    <span class="pt-1" style="font-weight:bold;color:gray;">Add to your status</span><label for="image" class="form-label pt-1"> <i class="fas fa-image" style="cursor: pointer;color:lightgreen;font-size: 30px;"> </i></label>
                    <input type="file" name="img" class="form-control" placeholder="Add to your status" id="image" style="display:none;">
                  </div>
                <button type="submit" class="btn btn-primary">POST</button>
            </form>
            <hr>
            @foreach($statuses as $status)
            <div class="status border p-3 bg-dark bg-opacity-10 mt-1 mb-1 d-flex justify-content-between">
                
                @if($status->img_path)
                    <div class="card-body">
                        <h5 class="card-title" style="font-size:20px;">{{$status->user->name}}</h5>
                        <p class="card-text ps-2 mb-0 pb-0">{{$status->status}}</p>
                        <div class="img-container pt-0 pb-1" style="aspect-ratio:1/1;width:300px;">
                            <img src="{{asset('/storage/'.$status->img_path)}}" alt="" class="src" style="width:100%;height:100%; object-fit:contain;">
                        </div>
                    </div>

                
                @else
                <div class="card-body">
                    <h5 class="card-title" style="font-size:20px;">{{$status->user->name}}</h5>
                    <p class="card-text ps-2">{{$status->status}}</p>
                </div>
                @endif
                    @if($status->user->id == auth()->user()->id)
                    <div class="actions">

                        <a href="{{route('editPost',$status->id)}}" class="btn btn-primary" ><i class="fas fa-pen-nib" style="width:20px; height:20px; color:white;"></i></a>
                        <a href="{{route('deletePost',$status->id)}}" class="btn btn-danger" ><i class="fas fa-trash" style="width:20px; height:20px; color:white;"></i></a>

                    </div>

                    @endif
                
                
                
            </div>
            @endforeach
        </div>
    </div>
    
  </div>

@endsection