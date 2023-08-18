<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelRoomTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'hotel_id'=>$this->id,
            'room_type_id'=>$this->id,
            'accommodation_id'=>$this->id,
            'quantity'=>$this->quantity,
            'url'=> route('hotel-rooms.show', $this->id)
        ];
    }
}
