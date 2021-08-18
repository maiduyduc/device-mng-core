<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documents')->insert([
            ['number' => 1, 'document_prefix_id' => 1, 'full_number' => 'CV-00001', 'qty' => 67, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 2, 'document_prefix_id' => 1, 'full_number' => 'CV-00002', 'qty' => 15, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 3, 'document_prefix_id' => 1, 'full_number' => 'CV-00003', 'qty' => 20, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 4, 'document_prefix_id' => 1, 'full_number' => 'CV-00004', 'qty' => 10, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 5, 'document_prefix_id' => 1, 'full_number' => 'CV-00005', 'qty' => 25, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
