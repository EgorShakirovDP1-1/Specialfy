<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(ReservationStoreRequest $request) {
        
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id;
        $reservation->film_id = $request->filmId;
        $reservation->start_date = $request->start_date;
        $reservation->film_pickup_place = $request->film_pickup_place;
        $reservation->film_return_place = $request->film_return_place;
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
        $reservation->end_price = $request->end_price;
        $reservation->watch = $request->watch;
        $reservation->save();

        return redirect()->route('home')->with('message', 'Film is ready to be watched!');
    }
}
