<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome'); 
});
Route::get('/about', function () {
    return view('user.about'); 
});
Route::get('/contact', function () {
    return view('user.contact'); 
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/home', [HomeController::class, 'index'])->name('user.index');
    Route::get('/new', function () {
        return view('user.new'); 
    });
    Route::get('/planTrip', [TripController::class, 'show']);
    Route::post('/planTrip', [TripController::class, 'store'])->name('trips.store');

    Route::get('/tripDay/{id}', [TripController::class, 'showTrip'])->name('trips.tripDay');
    Route::post('/tripDay/delete/{id}', [TripController::class, 'delete']);
    Route::get('/share/{id}', [TripController::class, 'showShareTrip']);
    Route::post('/trips/join/{tripId}', [TripController::class, 'joinShareTrip'])->name('trips.join');

    Route::post('/storePlaces', [PlaceController::class, 'storePlaces'])->name('place.store');
    Route::get('/deletePlace/{id}', [PlaceController::class, 'deletePlace']);

    Route::get('/trips/search', [HomeController::class, 'search'])->name('search.trips');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

