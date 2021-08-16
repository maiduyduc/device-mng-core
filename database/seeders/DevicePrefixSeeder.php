<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicePrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device_prefixes')->insert([
            ['prefix' => 'TB', 'display_name' => 'Thiết bị khác'],
            ['prefix' => 'MT', 'display_name' => 'Máy tính'],
            ['prefix' => 'MH', 'display_name' => 'Màn hình'],
            ['prefix' => 'RMT', 'display_name' => 'Ram'],
            ['prefix' => 'MC', 'display_name' => 'Máy chiếu'],
            ['prefix' => 'CASE', 'display_name' => 'Case'],
        ]);
    }
}
