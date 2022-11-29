<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Status</title>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      .nav-link:hover{
        color:gray;
      }
      </style>
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark">
        <div class="d-flex w-100 justify-content-between">
          <a class="navbar-brand" href="{{route('dashboard')}}">STATUS</a>
          
          @auth 
          <form action="{{route('searchFriend')}}" method="post" class="d-flex"  role="search">
            @csrf
            <input class="form-control me-2 " type="search" placeholder="   Search Friend " aria-label="Search" name="email">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>  
          <div class="nav">
            <div class="nav-item "> 

              <div class="dropdown">
                <button class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class=" fas fa-user-group" style="width:30px; height:30px; color:white;"></i> 
                  @if($friendRequestCount>0)
                  <span style="font-size: 9px;"> {{$friendRequestCount}} </span>
                  @endif

                </button>
                @if($friendRequestCount>0)
                <ul class="dropdown-menu">
                  @foreach($friendRequests as $friendRequest)
                
                  <li class="d-flex align-items-center">  <span class="ps-2 pe-2" style="font-size: 17px;">{{$friendRequest->name}}</span>  <a class="btn btn-primary me-2" href="{{route('acceptFriendRequest',$friendRequest->id)}}">Accept </a> <a class="btn btn-danger me-2" href="#">Deny </a> </li>
                 
                @endforeach
                </ul>
                @endif
              </div>
                </div>
                <div class="nav-item "> 
              <a href="" class="nav-link link-light">{{ucfirst(auth()->user()->name)}} </a>
                </div>
                <div class="nav-item">
                  <a href="{{route('logout')}}" class="nav-link  link-light">Signout</a>
  
                </div>
              </ul>
            @endauth
          

          </div>
        </div>
      </nav>


    @yield('content')

</body>
</html>