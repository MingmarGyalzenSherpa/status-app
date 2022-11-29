@extends('layout.app')

@section('content')
<div class="container p-2" style="max-width: 300px;">
    <form action="{{route('signupUser')}}" method="post" class=" p-3 rounded " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <h1>Sign Up</h1>
        @csrf
        <div class="mb-3">    
            @error('name') 
            <div class="alert alert-warning p-2" role="alert">
               {{$message}}
              </div>
            @enderror     
            <label for="name" class="form-label">User Name</label>
            <input type="name" class="form-control" id="name" name="name" >
            
        </div>
        <div class="mb-3">  
            @error('email') 
            <div class="alert alert-warning p-2" role="alert">
               {{$message}}
              </div>
            @enderror        
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" >
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-1">
            @error('password') 
            <div class="alert alert-warning p-2" role="alert">
               {{$message}}
              </div>
            @enderror 
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <span style="font-size: 12px;">Already have an account? <a href="{{route('login')}}" class="link">Login</a> </span>
        <button type="submit" style="width:100%;" class="btn btn-primary mt-2">Submit</button>
      </form>
</div>
@endsection