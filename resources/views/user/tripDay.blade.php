@extends('layouts.main')
@section('main-container')

<!-- contact section -->
<section class="contact_section long_section mt-5">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="text-start">
               <h2>{{ $tripData['place'] }}</h2>
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
                                       Place: {{ $place->place }}
                                       Note: {{ $place->note }}
                                       <a href="{{ url('/deletePlace/' . $place->id ) }}">
                                          <i class="fas fa-trash delete-icon" ></i>
                                       </a> 
                                 </div>
                              @endforeach
                           @endif
                        @endif

                        <form action="{{ route('place.store') }}" method="POST">
                           @csrf

                           <div class="form-group">
                              <label for="places{{ $index }}">Places:</label>
                              <input type="text" class="form-control place" name="place">
                           </div>
                           <div class="form-group">
                              <label for="note">Note:</label>
                              <input type="text" class="form-control note" name="note">
                           </div>
                           <input type="hidden" name="date" value="{{ date('Y-m-d', strtotime($date)) }}">
                           <input type="hidden" name="trip_id" value="{{ $tripData['id'] }}">
                           <button type="submit" class="btn btn-primary">Add Place</button>
                        </form>
                        
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