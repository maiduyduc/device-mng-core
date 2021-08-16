<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            ['name' => '201-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '202-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '301-1A-A17', 'num_of_equip' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '302-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '303-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '401-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '402-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '403-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '501-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '502-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => '503-1A-A17', 'num_of_equip' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
