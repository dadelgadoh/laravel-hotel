<?php

namespace App\Http\Requests;

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
        // hotel_id 'room_type_id', 'accommodation_id', 'quantity'
        return [
            'hotel_id'=> ['required'],
            'room_type_id'=> ['required'],
            'accommodation_id'=> ['required'],
            'quantity'=> ['required']
        ];
    }
}
