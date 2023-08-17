<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
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
        // 'name', 'address', 'city', 'nit', 'no_rooms'
        return [
            'name'=> ['required'],
            'address'=> ['required'],
            'city'=> ['required'],
            'nit'=> ['required'],
            'nit'=> ['required', Rule::unique('hotels')->ignore($this->hotel)],
            // 'nit'=> ['required', 'unique:hotels,nit,' . $this->hotel->id],
            'no_rooms'=> ['required'],
        ];
    }
}
