<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Mail\ReservationMailGuest;
use App\Mail\ReservationMailHotel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Room;
use App\Reservation;

class ReservationController extends Controller
{
    public function create()
    {
        $rooms = Room::all();

        //Pass all the rooms data to the view
        return view('reserve', compact('rooms'));
    }

    //Update price any time a new date or room is selected with validation
    public function updatePrice(Request $request){
        $validator = Validator::make($request->all(),[
            'arrival_date' => 'required|date|after_or_equal:today',
            'departure_date' => 'required|date|after:today|after:arrival_date',
            'room_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            // Return a custom response on failure
            return response()->json([
                'price' => 0,
                'errors' => $validator->errors()
            ]);
        }
    
        $validated = $validator->validated();
        
        $arrivalDate = Carbon::parse($validated['arrival_date']);
        $departureDate = Carbon::parse($validated['departure_date']);
        $room = Room::find($validated['room_id']);
        $price = $arrivalDate->diffInDays($departureDate) * $room['price_per_night'];
        
        return response()->json(['price' => $price]); 
    }

    //Store function that creates a reservation object and sends mails to the guest and the hotel
    public function store(StoreReservationRequest $request)
    {   
        $validated = $request->validated();

        Reservation::create($validated);


        $arrivalDate = Carbon::parse($validated['arrival_date']);
        $departureDate = Carbon::parse($validated['departure_date']);
        $room = Room::find($validated['room_id']);
        $price = $arrivalDate->diffInDays($departureDate) * $room['price_per_night'];

        // Funkcije za pošiljane pošto so zakomentirane, saj demo Mailtrap dovoljuje samo pošiljanje na lasten naslov.
        //Mail::to($validated['email'])->send(new ReservationMailGuest($room["name"],$room["short_description"],$validated["arrival_date"], $validated["departure_date"],$price));
        //Mail::to($validated['email'])->send(new ReservationMailHotel($validated,$price, $room['name']));

        return redirect("thanks");

    }

    public function thanks(){
        return view('thanks');
    }
}
