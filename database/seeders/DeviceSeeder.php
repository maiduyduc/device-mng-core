<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->insert([
            ['number' => 1, 'device_prefix_id' => 3, 'full_number' => 'MH-00001', 'room_id' => 3, 'device_group_id' => 1, 'category_id' => 2, 'handover_id' => 1, 'device_name' => 'Màn hình dell', 'device_info' => '24 inch', 'serial' => '', 'unit' => 'Chiếc', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['number' => 2, 'device_prefix_id' => 4, 'full_number' => 'RMT-00001', 'room_id' => 3, 'device_group_id' => 1, 'category_id' => 2, 'handover_id' => 1, 'device_name' => 'Ram máy tính 8Gb', 'device_info' => '8Gb', 'serial' => '', 'unit' => 'Thanh', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
