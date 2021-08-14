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
        $adminRole = Role::create(['name' => 'admin']);
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 1,
        ]);
        $ktvRole = Role::create(['name' => 'ktv']);
        RoleHierarchy::create([
            'role_id' => $ktvRole->id,
            'hierarchy' => 2,
        ]);
        $ptbRole = Role::create(['name' => 'ptb']);
        RoleHierarchy::create([
            'role_id' => $ptbRole->id,
            'hierarchy' => 3,
        ]);

        $trkRole = Role::create(['name' => 'trk']);
        RoleHierarchy::create([
            'role_id' => $trkRole->id,
            'hierarchy' => 4,
        ]);

        /*  insert users   */
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'admin'
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'ktv',
            'email' => 'ktv@ktv.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'ktv'
        ]);
        $user->assignRole('ktv');

        $user = User::create([
            'name' => 'ptb',
            'email' => 'ptb@ptb.com',
            'email_verified_at' => now(),
            'password' => '$2a$12$T7HYl3wEyaAgWI/V/ukugu8BubpxjdBtzM4FpD6NHRPK/HtmZFYM2', // 123
            'remember_token' => Str::random(10),
            'menuroles' => 'ptb'
        ]);
        $user->assignRole('ptb');

        $user = User::create([
            'name' => 'trk',
            'email' => 'trk@trk.com',
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
