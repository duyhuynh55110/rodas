<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => ACCOUNT_ROLE_ADMIN,
                'created_by' => CREATED_BY_SYSTEM,
                'created_at' => Carbon::now(),
                'updated_by' => CREATED_BY_SYSTEM,
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => ACCOUNT_ROLE_USER,
                'created_by' => CREATED_BY_SYSTEM,
                'created_at' => Carbon::now(),
                'updated_by' => CREATED_BY_SYSTEM,
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
