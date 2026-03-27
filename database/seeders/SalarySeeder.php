<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    public function run(): void
    {
        $salaries = [
            [
                'emp_no'     => 1,
                'salary'     => 55000.00,
                'from_date'  => '2024-01-15',
                'to_date'    => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'     => 2,
                'salary'     => 45000.00,
                'from_date'  => '2024-02-01',
                'to_date'    => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'     => 3,
                'salary'     => 70000.00,
                'from_date'  => '2023-06-10',
                'to_date'    => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'     => 4,
                'salary'     => 40000.00,
                'from_date'  => '2024-03-20',
                'to_date'    => null,
                'updated_at' => now(),
            ],
            [
                'emp_no'     => 5,
                'salary'     => 38000.00,
                'from_date'  => '2024-04-05',
                'to_date'    => null,
                'updated_at' => now(),
            ],
        ];

        DB::table('salaries')->insert($salaries);
    }
}
