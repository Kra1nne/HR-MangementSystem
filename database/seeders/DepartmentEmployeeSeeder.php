<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department_employee = [
            [
                'emp_no' => 2,
                'dept_no' => 1, 
                'from_date' => '2026-03-23',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'emp_no' => 1,
                'dept_no' => 1, 
                'from_date' => '2026-03-23',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'emp_no' => 4,
                'dept_no' => 2, 
                'from_date' => '2026-03-23',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'emp_no' => 3,
                'dept_no' => 2, 
                'from_date' => '2026-03-23',
                'status' => 'active',
                'created_at' => now()
            ]
        ];

        DB::table('department_employees')->insert($department_employee);
    }
}
