@extends('layouts.main')
@section('main-container')
<!-- contact section -->
<section class="contact_section long_section mt-5">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form_container">
                    <div class="text-center">
                        <h2>Plan a new trip</h2>
                    </div>
                    <form method="POST" action="{{ route('trips.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="place" placeholder="Where to? e.g. Paris, Hawaii, Japan">
                            @error('place')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="startDate" id="startDate" placeholder="Start Date">
                                @error('startDate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="endDate" id="endDate" placeholder="End Date">
                                @error('endDate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter an email address">
                            </div>
                            <div class="col-md-6">
                                <select name="visibility" id="visibility" class="form-select">
                                    <option value="solo">Solo</option>
                                    <option value="group">Group</option>
                                    <option value="family">Family</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Your Preferences:</label>
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="preferences[]" value="Adventurous" id="adventurous">
                                        <label class="form-check-label" for="adventurous">Adventurous</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="preferences[]" value="Relaxing" id="relaxing">
                                        <label class="form-check-label" for="relaxing">Relaxing</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="preferences[]" value="Off-the-Beaten-Path" id="off_the_beaten_path">
                                        <label class="form-check-label" for="off_the_beaten_path">Off-the-Beaten-Path</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="preferences[]" value="Luxurious" id="luxurious">
                                        <label class="form-check-label" for="luxurious">Luxurious</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="preferences[]" value="BudgetFriendly" id="BudgetFriendly">
                                        <label class="form-check-label" for="BudgetFriendly">Budget Friendly</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Start Planning</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end contact section -->
@endsection