<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applicants = [
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'applicant01@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'applicant02@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'applicant03@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'applicant04@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                 'email' => 'applicant54@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                 'email' => 'applicant06@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                 'email' => 'applicant07@voxsync.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
        ];

        DB::table('applications')->insert($applicants);
    }
}
