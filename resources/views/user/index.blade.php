@extends('layouts.main')
@section('main-container')

<!-- slider section -->
@if(Session::has('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="mt-5">
<div class="container text-start">
  <div class="row align-items-start">
    <div class="col-md-5">
      <h1> Enjoy Your Vacation  <br>
      With Us</h1>
      <p>
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minus quidem maiores perspiciatis, illo maxime voluptatem a itaque suscipit.
      </p>
      <a href="{{ url('/contact') }}">
        <button type="button" class="btn btn-primary">Contact Us</button>
      </a>
      
      <a href=" {{ url('/planTrip') }} ">
        <button type="button" class="btn btn-success">Plan new trip</button>
      </a>
      
    </div>
    
  </div>
</div>
</section>

 <section class="mt-5">
 <div class="container text-start">
  <div class="row">
    <div class="col-md-6">
      <h1> Your Trips</h1>
    </div>
    <div class="col-md-6">
      <form action="{{ route('search.trips') }}" method="GET" class="form-inline">
      <div class="row">
        <div class="col-md-10">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="query">
        </div>
        <div class="col-md-2">
          <button class="btn btn-outline-success " type="submit">Search</button>
        </div>
      </div>
      </form>
    </div>
  </div>
      
    
  <div class="row align-items-start" style="overflow:scroll; height:50vh">
  @foreach($trips as $trip)
    <div class="col-md-6 col-lg-4 mx-auto mb-4">
        <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{ $trip->place }}</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{ $trip->duration }}</h6>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{ $trip->visibility }}</h6>
          <p class="card-text">{{ $trip->preferences }}</p>
          <a href="{{ url('/tripDay/' . $trip->id) }}">Read More</a>
                
                <form id="delete-form-{{$trip->id}}" action="{{ url('/tripDay/delete/' . $trip->id)}}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="confirmDelete('{{ $trip->id }}');">
                    <span>Delete</span>
                </a>
                <!-- Unique ID for share popup by appending trip ID -->
                <div href="#" onclick="showSharePopup('{{ $trip->id }}');">
                    <i class="fa fa-share"></i>
                </div>

                <!-- Hidden share popup with unique ID -->
                <div id="sharePopup-{{ $trip->id }}" style="display: none;">
                    <p>Share this trip:</p>
                    <input type="text" id="shareLink-{{ $trip->id }}" readonly>
                    <button onclick="copyShareLink('{{ $trip->id }}')">Copy Link</button>
                </div>
         
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
 </section>


  @endsection