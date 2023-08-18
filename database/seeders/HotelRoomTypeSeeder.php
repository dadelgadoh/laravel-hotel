<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelRoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotel_room_types')->insert([
            'hotel_id' => 1,
            'room_type_id' => 1,
            'accommodation_id' => 1,
            'quantity' => 25,
        ]);

        DB::table('hotel_room_types')->insert([
            'hotel_id' => 1,
            'room_type_id' => 2,
            'accommodation_id' => 3,
            'quantity' => 12,
        ]);

        DB::table('hotel_room_types')->insert([
            'hotel_id' => 1,
            'room_type_id' => 1,
            'accommodation_id' => 2,
            'quantity' => 5,
        ]);
    }
}
