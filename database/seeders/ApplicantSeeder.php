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
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
            [
                'job_id' => 1,
                'status' => 'apply',
                'applied_at' => now()->toDateString(),
                'created_at' => now(),
            ],
        ];

        DB::table('applications')->insert($applicants);
    }
}
