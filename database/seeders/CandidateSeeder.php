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
                'person_id' => 5,
                'created_at' => now(),
            ],
            [
                'application_id' => 2,
                'person_id' => 6,
                'created_at' => now(),
            ],
            [
                'application_id' => 3,
                'person_id' => 7,
                'created_at' => now(),
            ],
            [
                'application_id' => 4,
                'person_id' => 8,
                'created_at' => now(),
            ],
            [
                'application_id' => 5,
                'person_id' => 9,
                'created_at' => now(),
            ]
        ];

        DB::table('candidates')->insert($candidates);
    }
}
