<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservation;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMailHotel extends Mailable
{
    use Queueable, SerializesModels;

    private $reservation;
    private $price;
    private $roomName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $reservation, int $price, string $roomName)
    {
        $this->reservation = $reservation;
        $this->price = $price;
        $this->roomName = $roomName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.hotelmail')
        ->with([
            'name'=> $this->reservation['name'],
            'email'=>$this->reservation['email'],
            'telephone'=>$this->reservation['telephone'],
            'date_arrive' => $this->reservation['arrival_date'],
            'date_depart'=> $this->reservation['departure_date'],
            'room_name' => $this->roomName,
            'extras'=> $this->reservation['extras'],
            'price'=> $this->price,
        ]);
    }
}
