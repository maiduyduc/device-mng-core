<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleHierarchySeeder::class,
            MenusTableSeeder::class,

            CategorySeeder::class,
            DevicePrefixSeeder::class,
            DocumentPrefixSeeder::class,
            RoomSeeder::class,
            DeviceGroupSeeder::class,
            DocumentSeeder::class,
            DocumentInfoSeeder::class,
            DevicePlanSeeder::class,
            DevicePlanInfoSeeder::class,
            DeviceSeeder::class,
        ]);
    }
}
