<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'city', 'nit', 'no_rooms'
    ];

    public function hotelRoomTypes()
    {
       return $this->hasMany(HotelRoomType::class);
    }
}
