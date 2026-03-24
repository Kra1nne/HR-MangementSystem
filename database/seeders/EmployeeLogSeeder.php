<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employeelogs = [
            [
                'dept_employee_id' => 1,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(8, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 1,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(12, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 1,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(13, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 1,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(17, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],

             [
                'dept_employee_id' => 2,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(8, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 2,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(12, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 2,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(13, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 2,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(17, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],

             [
                'dept_employee_id' => 3,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(8, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 3,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(12, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 3,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(13, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 3,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(17, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],

             [
                'dept_employee_id' => 4,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(8, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 4,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(12, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 1,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 4,
                'log_type' => 'IN',
                'time' => now()->copy()->setTime(13, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],
            [
                'dept_employee_id' => 4,
                'log_type' => 'OUT',
                'time' => now()->copy()->setTime(17, 0, 0), 
                'date' => now()->toDateString(),
                'row_number' => 2,
                'remarks' => 'Present',
                'created_at' => now()
            ],
        ];

        DB::table('employee_logs')->insert($employeelogs);
    }
}