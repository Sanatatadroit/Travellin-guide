@extends('layouts.main')
@section('main-container')

<section class="mt-5">
    <div class="container text-start">
    <h1>Your Search Results</h1>

    @if($query)
        <p>You are searching for: <strong>{{ $query }}</strong></p>
    @endif

    @if($trips->isEmpty())
        <p>No trips found matching your search criteria.</p>
    @else
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
    @endif

    </div>
</section>
            

@endsection