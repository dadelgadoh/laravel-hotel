<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            'name' => 'DECAMERON CARTAGENA',
            'address' => 'CALLE 23 58-25',
            'city' => 'CARTAGENA',
            'nit' => '12345678-9',
            'no_rooms' => 42
        ]);
    
        DB::table('hotels')->insert([
            'name' => 'DECAMERON SANTA MARTA',
            'address' => 'SANTAMARTA',
            'city' => 'SANTA MARTA',
            'nit' => '119012345678-9',
            'no_rooms' => 51
        ]);
    }
}





