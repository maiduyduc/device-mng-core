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
            ['prefix' => 'CV'],
            ['prefix' => 'DT'],
            ['prefix' => 'BG'],
            ['prefix' => 'KK'],
            ['prefix' => 'TL'],
        ]);
    }
}
