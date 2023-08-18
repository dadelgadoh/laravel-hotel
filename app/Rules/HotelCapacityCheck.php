<?php

namespace App\Rules;

use App\Http\Requests\StoreHotelRoomTypeRequest;
use App\Models\Hotel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HotelCapacityCheck implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $hotel_room_type_req;
    public function __construct(StoreHotelRoomTypeRequest $hotel_room_type_req)
    {
        $this->hotel_room_type_req = $hotel_room_type_req;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // return;
        $hotel_room_type_req = $this->hotel_room_type_req;
        $hotel_id = $hotel_room_type_req->hotel_id;
        try {
            $hotel = Hotel::findOrFail($hotel_id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return;
        }

        if (isset($hotel_room_type_req->hotel_room)) {
            // $hotel_room = $this->hotel_room_type_req->hotel_room;
            // $hotel_room_id = $hotel_room->id;
            $excludeId = $hotel_room_type_req->hotel_room->id;
        } else {
            $excludeId = false;
        }
        $quantity = $hotel_room_type_req->quantity;

        $roomQuantitySum = $excludeId ? $hotel->hotelRoomTypes()->where('id', '!=', $excludeId)->sum('quantity') : $hotel->hotelRoomTypes()->sum('quantity');
        $roomQuantitySum = $roomQuantitySum + $quantity; // Suma de datos en DB + el de la req
        $noRooms = $hotel->no_rooms; //Numero maximo de habitaciones del hotel

        if (($noRooms < $value)||($noRooms < $roomQuantitySum)) {
            $fail('The number of rooms is not valid.');
        }
        
    }

}
