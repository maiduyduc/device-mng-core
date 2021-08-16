<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device_plans')->insert([
            ['number' => 1, 'document_prefix_id' => 2, 'full_number' => 'DT-00001', 'qty' => 13, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'num_device_in_use' => 0, 'num_device_not_use' => 0,'created_at' => now(), 'updated_at' => now()],
            ['number' => 2, 'document_prefix_id' => 2, 'full_number' => 'DT-00002', 'qty' => 9, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'num_device_in_use' => 0, 'num_device_not_use' => 0,'created_at' => now(), 'updated_at' => now()],
            ['number' => 3, 'document_prefix_id' => 2, 'full_number' => 'DT-00003', 'qty' => 5, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'num_device_in_use' => 0, 'num_device_not_use' => 0,'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
