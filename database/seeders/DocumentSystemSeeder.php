<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_systems')->insert([
            ['document_id' => '1', 'pending' => 5 ,'total' => 5 ,'created_at' => now(), 'updated_at' => now()],
            ['document_id' => '2', 'pending' => 3 ,'total' => 3 ,'created_at' => now(), 'updated_at' => now()],
            ['document_id' => '3', 'pending' => 0 ,'total' => 0 ,'created_at' => now(), 'updated_at' => now()],
            ['document_id' => '5', 'pending' => 0 ,'total' => 0 ,'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
