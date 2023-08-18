<?php

namespace App\Rules;

use App\Http\Requests\StoreHotelRoomTypeRequest;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AccommodationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $room_type_id;
    public function __construct($room_type_id)
    {
        $this->room_type_id = $room_type_id;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // return;
        $room_type_id = $this->room_type_id;
        $accommodation_id = $value;
        $accomodation_valid = true;

        if ($room_type_id === 1 && !in_array($accommodation_id, [1, 2])) {
            $accomodation_valid = false;
        } elseif ($room_type_id === 2 && !in_array($accommodation_id, [3, 4])) {
            $accomodation_valid = false;
        } elseif ($room_type_id === 3 && !in_array($accommodation_id, [1, 2, 3])) {
            $accomodation_valid = false;
        }

        if (!$accomodation_valid) {
            $fail('The accommodation is not valid.');
        }
    }
}
