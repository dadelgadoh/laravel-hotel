<?php

namespace App\Rules;

use App\Models\Hotel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class HotelCapacityCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $hotel_id;
    public function __construct($hotel_id)
    {
        $this->hotel_id = $hotel_id;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hotel = Hotel::findOrFail($this->hotel_id);

        $noRooms = $hotel->no_rooms;
        Log::info('Valor de la variable:', ['hotel' => $hotel]);
        Log::info('Valor de la variable:', ['noRooms' => $noRooms]);
        if (($noRooms < $value)) {
            $fail('The number of rooms is not valid.');
        }
        //
        // $hotel = Hotel::find($value); 
        // // $hotel = Hotel::where('hotel_id', $value); 
        // Log::info('Valor de la variable:', ['value' => $value]);
        // Log::info('Valor de la variable hotel:', ['hotel' => $hotel]);
    }
}
