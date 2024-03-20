<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use DateTime; 
use DateInterval;
use DatePeriod;


class PlaceController extends Controller
{
    public function storePlaces(Request $request)
    {
        $userId = Auth::id();
        $trip_id = $request->trip_id;
        $validated = $request->validate([
            'place' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        $place = new Place();
        $place->place = $request->place;
        $place->note = $request->note;
        $place->date = $request->date;
        $place->user_id = $userId;
        $place->trip_id = $trip_id;

        $place->save();

        $places = Place::where('user_id', $userId)
        ->where('trip_id', $trip_id)
        ->get();
    
        $trip = Trip::Where('id', $trip_id)->where('user_id', $userId)->first();
    
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
    

        return back()->with([
            'places' => $places,
            'tripData' => $trip,
            'dates' => $dates,
            'success' => 'Place added successfully'
        ]);
    }

    public function deletePlace($id)
    {
        $userId = Auth::id();
    
        $trip = Place::where('id', $id)->where('user_id', $userId)->delete();
    
        if ($trip) {
            session()->flash('message', 'Trip deleted successfully.');
        } else {
            session()->flash('message', 'Trip not found or you are not authorized to delete.');
        }
    
        return redirect()->back();
    }
}
