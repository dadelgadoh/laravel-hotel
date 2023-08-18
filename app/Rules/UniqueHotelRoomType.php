<?php

namespace App\Rules;

use App\Http\Requests\StoreHotelRoomTypeRequest;
use App\Models\HotelRoomType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueHotelRoomType implements ValidationRule
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
        $hotel_room_type_req = $this->hotel_room_type_req;

        if (isset($hotel_room_type_req->hotel_room)) {
            // $hotel_room = $this->hotel_room_type_req->hotel_room;
            // $hotel_room_id = $hotel_room->id;
            $count = false;
        } else {
            
            $count = HotelRoomType::where(function ($query) use ($hotel_room_type_req) {
                return $query->where('hotel_id', $hotel_room_type_req->hotel_id)
                    ->where('room_type_id', $hotel_room_type_req->room_type_id)
                    ->where('accommodation_id', $hotel_room_type_req->accommodation_id);
            })->count();
        }

        if ($count) {
            $fail('Room configuration quantity already exists.');
        }
    }
}
