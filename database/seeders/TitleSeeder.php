<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            [
                'emp_no'    => 1,
                'title'     => 'HR Manager',
                'from_date' => '2024-01-15',
                'to_date'   => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'    => 2,
                'title'     => 'HR Specialist',
                'from_date' => '2024-02-01',
                'to_date'   => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'    => 3,
                'title'     => 'IT Manager',
                'from_date' => '2023-06-10',
                'to_date'   => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'    => 4,
                'title'     => 'Software Developer',
                'from_date' => '2024-03-20',
                'to_date'   => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'    => 5,
                'title'     => 'Accounting Clerk',
                'from_date' => '2024-04-05',
                'to_date'   => '2024-12-31',
                'updated_at' => now(),
            ],
        ];

        DB::table('titles')->insert($titles);
    }
}
