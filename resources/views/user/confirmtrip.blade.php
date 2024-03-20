@extends('layouts.main')
@section('main-container')
<!-- contact section -->
<section class="contact_section long_section mt-5">
    <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="text-start">
               <h2>Thank you for creating the Trip.</h2>
            </div> 
            <button class="btn btn-success"><a href="{{ url('/tripDay/' . $tripData['id']) }}" style="text-decoration:none; color:white">Lets Go!!</a></button>
            </div>
        </div>
    </div>
</section>

<!-- end contact section -->
@endsection