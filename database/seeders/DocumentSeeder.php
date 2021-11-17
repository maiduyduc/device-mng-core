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
            ['number' => 1, 'document_prefix_id' => 1, 'full_number' => 'CV-00001', 'name' => 'CV mua sắm thiết bị kì I năm học 2021 - 2022', 'qty' => 67, 'status' => 'accept', 'can_edit' => 0, 'can_export' => 1, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 2, 'document_prefix_id' => 1, 'full_number' => 'CV-00002', 'name' => 'CV mua sắm thiết bị kì II năm học 2021 - 2022', 'qty' => 15, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 3, 'document_prefix_id' => 1, 'full_number' => 'CV-00003', 'name' => 'CV mua sắm thiết bị kì I năm học 2022 - 2023', 'qty' => 20, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 4, 'document_prefix_id' => 1, 'full_number' => 'CV-00004', 'name' => 'CV mua sắm thiết bị kì II năm học 2022 - 2023', 'qty' => 10, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['number' => 5, 'document_prefix_id' => 1, 'full_number' => 'CV-00005', 'name' => 'CV mua sắm thiết bị kì I năm học 2023 - 2024', 'qty' => 25, 'status' => 'pending', 'can_edit' => 1, 'can_export' => 0, 'is_export' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
