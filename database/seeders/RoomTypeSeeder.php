<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('room_types')->insert([
            'name' => 'standard'
        ]);
        DB::table('room_types')->insert([
            'name' => 'junior'
        ]);
        DB::table('room_types')->insert([
            'name' => 'suite'
        ]);
    }
}
