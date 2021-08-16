<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevicePlanInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device_plan_infos')->insert([
            ['category_id' => 2, 'device_plan_id' => 1, 'device_name' => 'MacBook M1', 'device_info' => 'Ram: 16Gb, SSD: 1Tb', 'unit' => 'Chiếc', 'qty' => 3, 'note' => 'mua cho giảng viên đi công tác', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'device_plan_id' => 1, 'device_name' => 'Dây mạng Cat5E', 'device_info' => '', 'unit' => 'Thùng', 'qty' => 5, 'note' => 'Thay thế dây mạng cũ', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'device_plan_id' => 1, 'device_name' => 'Đạn ghim 10 plus', 'device_info' => '', 'unit' => 'Hộp', 'qty' => 5, 'note' => '', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'device_plan_id' => 2, 'device_name' => 'MacBook M1 1', 'device_info' => 'Ram: 16Gb, SSD: 1Tb', 'unit' => 'Chiếc', 'qty' => 3, 'note' => 'mua cho giảng viên đi công tác', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'device_plan_id' => 2, 'device_name' => 'MacBook M1 2', 'device_info' => 'Ram: 16Gb, SSD: 1Tb', 'unit' => 'Chiếc', 'qty' => 5, 'note' => 'mua cho giảng viên đi công tác', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'device_plan_id' => 2, 'device_name' => 'MacBook M1 3', 'device_info' => 'Ram: 16Gb, SSD: 1Tb', 'unit' => 'Chiếc', 'qty' => 1, 'note' => 'mua cho giảng viên đi công tác', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'device_plan_id' => 3, 'device_name' => 'MacBook M1 4', 'device_info' => 'Ram: 16Gb, SSD: 1Tb', 'unit' => 'Chiếc', 'qty' => 2, 'note' => 'mua cho giảng viên đi công tác', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'device_plan_id' => 3, 'device_name' => 'MacBook M1 5', 'device_info' => 'Ram: 16Gb, SSD: 1Tb', 'unit' => 'Chiếc', 'qty' => 3, 'note' => 'mua cho giảng viên đi công tác', 'is_buy' => 0, 'is_in_use' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
