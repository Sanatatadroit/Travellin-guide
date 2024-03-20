<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Trip;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use DateTime; 
use DateInterval;
use DatePeriod;
use App\Models\User;
use App\Models\Place;


class TripController extends Controller
{
    public function show()
    {
        return view('user.planTrip');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'place' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'email' => 'nullable|email',
            'visibility' => 'nullable|string|in:solo,group,family',
            'preferences' => 'nullable|array', 
        ]);

        // Serialize preferences array into a comma-separated string
        $preferences = $request->has('preferences') ? implode(',', $validatedData['preferences']) : '';

        $startDate = new DateTime($validatedData['startDate']);
        $endDate = new DateTime($validatedData['endDate']);

        // Calculate the difference between start and end dates
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));

        $dates = [];
        foreach ($dateRange as $date) {
            // Format date as 'Day, DayOfMonthth Month'
            $dates[] = $date->format('l, jS F');
        }

        $validatedData['start_date'] = $startDate->format('Y-m-d');
        $validatedData['end_date'] = $endDate->format('Y-m-d');
        $validatedData['place'] = Str::ucfirst($validatedData['place']);
        $validatedData['user_id'] = Auth::id();
        $validatedData['preferences'] = $preferences; 

        // Create the Trip object and capture its ID
        $trip = Trip::create($validatedData);
        $validatedData['id'] = $trip->id;

        Session::flash('success', 'Trip information saved successfully!');

        return view('user.confirmtrip', [
            'tripData' => $validatedData,
            'dates' => $dates,
        ]);
    }

    public function showTrip( $id)
    {
        $userId = Auth::id();
    
        $trip = Trip::Where('id', $id)->where('user_id', $userId)->first();
    
        $dates = [];
        if ($trip) {
            $startDate = new DateTime($trip->start_date);
            $endDate = new DateTime($trip->end_date);
    
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));
    
            foreach ($dateRange as $date) {
                $dates[] = $date->format('l, jS F');
            }
        }

        $places = Place::where('user_id', $userId)
        ->where('trip_id', $id)
        ->get();
    
        return view('user.tripDay', [
            'places' => $places,
            'tripData' => $trip,
            'dates' => $dates,
        ]);
    }

    public function delete($id)
    {
        $userId = Auth::id();
    
        $trip = Trip::where('id', $id)->where('user_id', $userId)->delete();
    
        if ($trip) {
            session()->flash('message', 'Trip deleted successfully.');
        } else {
            session()->flash('message', 'Trip not found or you are not authorized to delete.');
        }
    
        return redirect()->route('user.index');
    }

   

    public function showShareTrip($id)
    {    
        $trip = Trip::where('id', $id)->first();
 
        $user = null;
        $sharedUserIds = explode(',', $trip->share_id);
        if ($trip) {
            $user = User::find($trip->user_id);
            $sharedUserIds = explode(',', $trip->share_id);
            foreach ($sharedUserIds as $userId) {
                $sharedUser = User::find($userId);
                if ($sharedUser) {
                    $sharedUsers[] = $sharedUser;
                }
            }
        }
    
        $dates = [];
        if ($trip) {
            $startDate = new DateTime($trip->start_date);
            $endDate = new DateTime($trip->end_date);
    
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));
    
            foreach ($dateRange as $date) {
                $dates[] = $date->format('l, jS F');
            }
        }

        $places = Place::where('trip_id', $id)
        ->get();

        return view('user.shareTrip', [
            'places' => $places,
            'trip' => $trip,
            'user' => $user,
            'sharedUsers' => $sharedUsers,
            'dates' => $dates,
        ]);
    }


    public function joinShareTrip(Request $request, $tripId)
    {
        $userId = Auth::id();
        $trip = Trip::find($tripId);
   
        if ($trip && strpos($trip->share_id, $userId) === false) {
            $trip->share_id = $trip->share_id ? $trip->share_id . ',' . $userId : $userId;
            $trip->save();

            Session::flash('success', 'You have joined the trip successfully!');
        }
  
        return redirect()->back();
    }
    
    
}
