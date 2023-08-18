<?php

namespace App\Http\Requests;

use App\Rules\HotelCapacityCheck;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

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
        // Log::info('Valor de la variable hotel room:', ['hotel room' => $this]);

        return [
            'hotel_id' => ['required', 'integer', 'exists:hotels,id'],
            'room_type_id' => ['required', 'integer', 'exists:room_types,id'],
            'accommodation_id' => ['required', 'integer', 'exists:accommodations,id',  Rule::unique('hotel_room_types')->where(function ($query) {
                return $query->where('hotel_id', $this->hotel_id)
                    ->where('room_type_id', $this->room_type_id)
                    ->where('accommodation_id', $this->accommodation_id);
            })->ignore($this->hotel_room)],
            // 'quantity' => ['required','integer','min:0', new HotelCapacityCheck($this->hotel_id)]
            'quantity' => ['required', 'integer', 'min:0', new HotelCapacityCheck($this)]
        ];
    }

    public function messages()
    {
        return [
            'accommodation_id.unique' => 'Room configuration quantity already exists.',
        ];
    }
}
