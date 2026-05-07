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
                'applied_at' => '2026-04-23',
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'susangarde5@gmail.com',
                'applied_at' => '2026-04-24',
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'susangarde5@gmail.com',
                'applied_at' => '2026-04-26',
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'email' => 'lesaga242006@gmail.com',
                'applied_at' => '2026-04-27',
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                 'email' => 'reymartjauod47@gmail.com',
                'applied_at' => '2026-04-27',
                'created_at' => now(),
            ],
        ];

        DB::table('applications')->insert($applicants);
    }
}
