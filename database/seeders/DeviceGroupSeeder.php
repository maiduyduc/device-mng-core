<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device_groups')->insert([
            ['name' => 'Máy 1 phòng 301-1A-A17', 'qty' => 0, 'room_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy 2 phòng 301-1A-A17', 'qty' => 0, 'room_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy 3 phòng 301-1A-A17', 'qty' => 0, 'room_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
