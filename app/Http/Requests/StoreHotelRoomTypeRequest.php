<?php

namespace App\Http\Requests;

use App\Rules\HotelCapacityCheck;
use App\Rules\UniqueHotelRoomType;
use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRoomTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'hotel_id' => ['required', 'integer', 'exists:hotels,id',new UniqueHotelRoomType($this)],
            'room_type_id' => ['required', 'integer', 'exists:room_types,id'],
            'accommodation_id' => ['required', 'integer', 'exists:accommodations,id'],
            'quantity' => ['required', 'integer', 'min:0', new HotelCapacityCheck($this)]
        ];
    }
}
