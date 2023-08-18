<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoomType extends Model
{
    // Modelo que relaciona la cantidad de habitaciones de un hotel dado el tipo de habitación y la acomodacion
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'room_type_id', 'accommodation_id', 'quantity'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
