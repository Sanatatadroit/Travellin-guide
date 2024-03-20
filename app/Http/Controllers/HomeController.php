<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;
use App\Models\Trip;


class HomeController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $trips = DB::table('trips')->where('user_id', $userId)->orderBy('id', 'desc')->get();
        
        foreach ($trips as $trip) {
            $startDate = new DateTime($trip->start_date);
            $endDate = new DateTime($trip->end_date);
            $interval = $startDate->diff($endDate);
            $trip->duration = $interval->format('%a days');
        }

        return view('user.index', ['trips' => $trips,]);
    }

    public function search (Request $request)
    {
        $userId = Auth::id();  
        $query = $request->input('query');
    
        $trips = Trip::where('user_id', $userId)->where('place', 'LIKE', "%$query%")->get();
        return view('user.searchTrip', compact('trips', 'query')); 
    }
}
