@extends('layouts.main')
@section('main-container')
<!-- contact section -->
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<section class="contact_section  long_section mt-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                <div class="text-start">
                <h2>
                    User: {{ $user->name }}
                    @if(isset($sharedUsers) && count($sharedUsers) > 0)
                        @foreach($sharedUsers as $sharedUser)
                            , {{ $sharedUser->name }}
                        @endforeach
                    @endif
                </h2>

                <h2>Trip :{{ $trip->place }}</h2>
            </div>
                </div>
                <div class="col-md-6">
                    <h4>Want to join {{ $user->name }}?</h4>
                    <form action="{{ route('trips.join', ['tripId' => $trip->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Join</button>
                    </form>
                </div>
            </div>
            
            
            @foreach ($dates as $index => $date)
            <div class="accordion" id="accordionExample{{ $index }} ">
               <div class="accordion-item">
                  <h2 class="accordion-header">
                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                     {{ $date }} 
                     </button>
                  </h2>
                  <div id="collapse{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample{{ $index }}">
                     <div class="accordion-body">
                        <!-- Filter places for the current date -->
                        @if(isset($places))
                           @php
                              $placesForDate = $places->where('date', date('Y-m-d', strtotime($date)));
                           @endphp

                           @if($placesForDate->isNotEmpty())
                              @foreach($placesForDate as $place)
                                 <div>
                                       <b>Place:</b> {{ $place->place }}
                                      <b>Note:</b>  {{ $place->note }}
                                 </div>
                              @endforeach
                           @endif
                        @endif
                        
                     </div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
</section>
<!-- end contact section -->
@endsection