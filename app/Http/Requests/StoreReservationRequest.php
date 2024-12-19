<?php

namespace App\Http\Requests;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required","string", "max:100"],
            "email" => ["required","email"],
            "telephone"=> ["required","string", "min:7", "max:14"],
            "room_id"=> ["required","integer"],
            "arrival_date"=> ["required","date", "after_or_equal:today"],
            "departure_date" => ["required","date", "after:today", "after:arrival_date"],
            "extras" => ["nullable","string", "max:1000"],
            "g-recaptcha-response" => [new ReCaptcha()]
            ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obvezno.',
            'name.max' => 'Ime mora imeti pod 100 znakov.',
            'email.required' => 'Email je obvezen.',
            'email.email' => 'Email ni pravilne oblike.',
            'telephone.required' => 'Telefonska številka je obvezna.',
            'telephone.min' => 'Telefonska številka ne sme biti krajša od 7 števk.',
            'telephone.max' => 'Telefonska številka ne sme biti daljša od 14 števk.',
            'room_id.required' => 'Izbor sobe je obvezen.',
            'arrival_date.required' => 'Datum prihoda je obvezen.',
            'arrival_date.date' => 'Datum prihoda mora biti veljavne oblike.',
            'arrival_date.after_or_equal' => 'Datum prihoda ne sme biti pred današnjim dnevom.',
            'departure_date.required' => 'Datum odhoda je obvezen.',
            'departure_date.date' => 'Datum odhoda mora biti veljavne oblike.',
            'departure_date.after' => 'Datum odhoda mora biti po današnjem dnevu in po dnevu prihoda.',
        ];
    }
}
