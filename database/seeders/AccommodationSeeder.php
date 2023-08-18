<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accommodations')->insert([
            'name' => 'single'
        ]);
        DB::table('accommodations')->insert([
            'name' => 'double'
        ]);
        DB::table('accommodations')->insert([
            'name' => 'triple'
        ]);
        DB::table('accommodations')->insert([
            'name' => 'quadruple'
        ]);
    }
}
