<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMailGuest extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $description;
    private $date_arrive;
    private $date_depart;
    private $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name,string $description, string $date_arrive, string $date_depart, int $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->date_arrive = $date_arrive;
        $this->date_depart = $date_depart;
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.guestmail')
                    ->with([
                        'name'=> $this->name,
                        'description'=> $this->description,
                        'date_arrive' => $this->date_arrive,
                        'date_depart'=> $this->date_depart,
                        'price'=> $this->price,
                    ]);
    }
}
