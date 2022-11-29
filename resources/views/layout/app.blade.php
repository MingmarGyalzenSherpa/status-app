<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Status</title>
    @vite(['resources/js/app.js'])
    <style>
      .nav-link:hover{
        color:gray;
      }
      </style>
</head>
<body>
    
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('dashboard')}}">STATUS</a>
          
          @auth 
          <form action="{{route('searchFriend')}}" method="post" class="d-flex"  role="search">
            @csrf
            <input class="form-control me-2 " type="search" placeholder="   Search Friend " aria-label="Search" name="email">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          
           
              <div class="nav-item "> 
            <a href="" class="nav-link link-light">{{ucfirst(auth()->user()->name)}} </a>
              </div>
              <div class="nav-item">
                <a href="{{route('logout')}}" class="nav-link  link-light">Signout</a>

              </div>
            </ul>
          @endauth
        
        </div>
      </nav>


    @yield('content')

</body>
</html>