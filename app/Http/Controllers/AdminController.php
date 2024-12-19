<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Return view with all Rooms listed
    public function index(){
        $rooms = Room::all();

        return view("admin", compact('rooms'));
    }

    //Return view for editing
    public function edit(int $room_id){   
        $room = Room::find($room_id);
        return view('editroom', compact('room'));
    }

    //Validate update function for Room editing and then update object
    public function update(Request $request, int $room_id){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_night' => 'required|integer|min:1',
            'short_description' =>'required|string|min:1|max:500',
            'long_description' =>'required|string|min:1|max:1000',
        ]);

        Room::find($room_id)->update($validated);

        return redirect()->route('admin')->with('success', 'Room updated successfully!');

    }
}
