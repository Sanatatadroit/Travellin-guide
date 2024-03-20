<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <link rel="icon" href="{{ URL::asset('assets/images/fevicon.png') }}" type="image/gif" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>ITINERARY</title>
      <!-- bootstrap core css -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <!-- font awesome style -->
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <body>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
         <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}"><b>ITINERARY</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                  @if (Auth::check())
                  <li class="nav-item">
                     <a class="nav-link active " aria-current="page" href="{{ url('/home') }}">Home</a>
                  </li>
                  @endif
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="{{ url('/about') }}">About</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="{{ url('/contact') }}">Contact Us</a>
                  </li>
               </ul>
               @if (Auth::check())
               <!-- If user is logged in, show logout button -->
               <form id="logout-form" class="d-flex" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
               </form>
               <a href="#" class="nav-link active" aria-current="page"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               <span>Logout</span>
               <i class="fa fa-sign-out" aria-hidden="true"></i>
               </a>
               <a href="{{ route('profile.edit')}}" class="nav-link active ms-4 "><span>Profile</span><i class="fa fa-user" aria-hidden="true"></i></a>
               @else
               <!-- If user is not logged in, show login and register links -->
               <a href="{{ route('login') }}">
               <span>Login</span>
               <i class="fa fa-user" aria-hidden="true"></i>
               </a>
               <a href="{{ route('register') }}">
               <span>Register</span>
               <i class="fa fa-user" aria-hidden="true"></i>
               </a>
               @endif
            </div>
         </div>
      </nav>