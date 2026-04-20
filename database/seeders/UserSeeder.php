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
                'email'              => 'hr@voxsync.com',
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
                'email'              => 'manager@voxsync.com',
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
                'email'              => 'employee1@voxsync.com',
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
                'person_id'          => 5,
                'email'              => 'employee2@voxsync.com',
                'password'           => Hash::make('password'),
                'role'               => 'Employee',
                'otp'                => null,
                'email_verified_at'  => now(),
                'status_request'     => 'Active',
                'otp_validity'       => now()->addHours(1),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'person_id' => 6,
                'email' => 'juan.delacruz@voxsync.com',
                'password' => Hash::make('password'),
                'role' => 'Employee',
                'otp' => null,
                'email_verified_at' => now(),
                'status_request' => 'Active',
                'otp_validity' => now()->addHours(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 7,
                'email' => 'maria.lopez@voxsync.com',
                'password' => Hash::make('password'),
                'role' => 'Employee',
                'otp' => null,
                'email_verified_at' => now(),
                'status_request' => 'Active',
                'otp_validity' => now()->addHours(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 8,
                'email' => 'carlos.reyes@voxsync.com',
                'password' => Hash::make('password'),
                'role' => 'Admin',
                'otp' => null,
                'email_verified_at' => now(),
                'status_request' => 'Active',
                'otp_validity' => now()->addHours(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 9,
                'email' => 'ana.fernandez@voxsync.com',
                'password' => Hash::make('password'),
                'role' => 'Employee',
                'otp' => null,
                'email_verified_at' => now(),
                'status_request' => 'Pending',
                'otp_validity' => now()->addHours(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 10,
                'email' => 'employee100@voxsync.com',
                'password' => Hash::make('password'),
                'role' => 'Employee',
                'otp' => null,
                'email_verified_at' => now(),
                'status_request' => 'Active',
                'otp_validity' => now()->addHours(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}