<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'person_id'          => 1,
                'email'              => 'cabarrubias1002@gmail.com',
                'password'           => Hash::make('password'),
                'role'               => 'Admin',
                'otp'                => null,
                'email_verified_at'  => now(),
                'status_request'     => 'Active',
                'otp_validity'       => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'person_id'          => 2,
                'email'              => 'judycabarrubias06@gmail.com',
                'password'           => Hash::make('password'),
                'role'               => 'Hr',
                'otp'                => null,
                'email_verified_at'  => now(),
                'status_request'     => 'Active',
                'otp_validity'       => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'person_id'          => 3,
                'email'              => 'm.cello09x@gmail.com',
                'password'           => Hash::make('password'),
                'role'               => 'Employee',
                'otp'                => null,
                'email_verified_at'  => now(),
                'status_request'     => 'Active',
                'otp_validity'       => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'person_id'          => 4,
                'email'              => 'gomalalaine12@gmail.com',
                'password'           => Hash::make('password'),
                'role'               => 'Manager',
                'otp'                => null,
                'email_verified_at'  => now(),
                'status_request'     => 'Active',
                'otp_validity'       => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ]
        ];

        DB::table('users')->insert($users);
    }
}