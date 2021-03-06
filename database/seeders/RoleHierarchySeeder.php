<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\RoleHierarchy;

class RoleHierarchySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 3;
        $usersIds = array();
        $faker = Faker::create();
        /* Create roles */
        $SadminRole = Role::create(['name' => 'sadmin', 'display_name' => 'Super Admin']);
        RoleHierarchy::create([
            'role_id' => $SadminRole->id,
            'hierarchy' => 1,
        ]);

        $adminRole = Role::create(['name' => 'admin', 'display_name' => 'System Admin']);
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 2,
        ]);
        $ktvRole = Role::create(['name' => 'ktv', 'display_name' => 'Kỹ thuật viên']);
        RoleHierarchy::create([
            'role_id' => $ktvRole->id,
            'hierarchy' => 3,
        ]);
        $ptbRole = Role::create(['name' => 'ptb', 'display_name' => 'Phòng thiết bị']);
        RoleHierarchy::create([
            'role_id' => $ptbRole->id,
            'hierarchy' => 4,
        ]);

        $trkRole = Role::create(['name' => 'trk', 'display_name' => 'Trưởng khoa']);
        RoleHierarchy::create([
            'role_id' => $trkRole->id,
            'hierarchy' => 5,
        ]);

        /*  insert users   */
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@super',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'sadmin'
        ]);
        $user->assignRole('sadmin');

        $user = User::create([
            'name' => 'System Admin',
            'email' => 'admin@admin',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'admin'
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Kỹ thuật viên',
            'email' => 'ktv@ktv',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'ktv'
        ]);
        $user->assignRole('ktv');

        $user = User::create([
            'name' => 'Phòng thiết bị',
            'email' => 'ptb@ptb',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'ptb'
        ]);
        $user->assignRole('ptb');

        $user = User::create([
            'name' => 'Trưởng khoa',
            'email' => 'trk@trk',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'trk'
        ]);
        $user->assignRole('trk');

        /*for($i = 0; $i<$numberOfUsers; $i++){
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
                'remember_token' => Str::random(10),
                'menuroles' => 'user'
            ]);
            $user->assignRole('user');
            array_push($usersIds, $user->id);
        }*/

    }
}
