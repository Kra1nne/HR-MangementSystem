<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidates = [
            [
                'application_id' => 1,
                'person_id' => 11,
                'created_at' => now(),
            ],
            [
                'application_id' => 2,
                'person_id' => 12,
                'created_at' => now(),
            ],
            [
                'application_id' => 3,
                'person_id' => 13,
                'created_at' => now(),
            ],
            [
                'application_id' => 4,
                'person_id' => 14,
                'created_at' => now(),
            ],
            [
                'application_id' => 5,
                'person_id' => 15,
                'created_at' => now(),
            ],
            [
                'application_id' => 6,
                'person_id' => 16,
                'created_at' => now(),
            ],
            [
                'application_id' => 7,
                'person_id' => 17,
                'created_at' => now(),
            ]
        ];

        DB::table('candidates')->insert($candidates);
    }
}
