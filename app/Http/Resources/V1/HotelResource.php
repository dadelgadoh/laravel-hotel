<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'hotelName'=>$this->name,
            'address'=>$this->address,
            'city'=>$this->city,
            'nit'=>$this->nit,
            'no_rooms'=>$this->no_rooms,
            'url'=> route('hotels.show', $this->id)
        ];
    }
}
