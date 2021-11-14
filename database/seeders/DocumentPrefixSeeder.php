<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentPrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_prefixes')->insert([
            ['prefix' => 'CV', 'display_name' => 'Công Văn Mua Sắm'],
            ['prefix' => 'DT', 'display_name' => 'Dự Trù'],
            ['prefix' => 'BG', 'display_name' => 'Bàn Giao'],
            ['prefix' => 'KK', 'display_name' => 'Kiểm Kê'],
            ['prefix' => 'TL', 'display_name' => 'Thanh Lý'],
            ['prefix' => 'AKK', 'display_name' => 'Kiểm Kê Tự Động'],
        ]);
    }
}
