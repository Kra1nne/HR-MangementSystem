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
                'email' => 'jenniferlagua18@gmail.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'susangarde5@gmail.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'susangarde5@gmail.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'lesaga242006@gmail.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                 'email' => 'reymartjauod47@gmail.com',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
        ];

        DB::table('applications')->insert($applicants);
    }
}
