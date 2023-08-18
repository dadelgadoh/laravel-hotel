<?php

namespace App\Rules;

use App\Http\Requests\StoreHotelRoomTypeRequest;
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

    // protected $hotel_id;
    // public function __construct($hotel_id)
    // {
    //     $this->hotel_id = $hotel_id;
    // }
    protected $hotel_room_type_req;
    public function __construct(StoreHotelRoomTypeRequest $hotel_room_type_req)
    {
        $this->hotel_room_type_req = $hotel_room_type_req;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $hotel_id = $this->hotel_room_type_req->hotel_id;
        $hotel = Hotel::findOrFail($hotel_id);
        // $hotel = Hotel::findOrFail($this->hotel_id);

        $noRooms = $hotel->no_rooms; //Numero maximo de habitaciones del hotel
        $roomQuantitySum = $hotel->hotelRoomTypes()->sum('quantity');
        
        // Log::info('Valor de la variable:', ['hotel' => $hotel]);
        // Log::info('Valor de la variable:', ['noRooms' => $noRooms]);
        if (($noRooms < $value)||($noRooms < $roomQuantitySum)) {
            $fail('The number of rooms is not valid.');
        }
        
    }

}
