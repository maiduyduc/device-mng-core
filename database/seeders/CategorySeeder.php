<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Bàn ghế', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy tính', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thiết bị mạng', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dụng cụ mỹ thuật', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Thiết bị khác', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
