<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // person_id references persons.id (1–5)
        $employees = [
            [
                'person_id'       => 1,
                'emp_id'          => 'EMP-2024-001',
                'hire_date'       => '2024-01-15',
                'status'          => 'active',
                'face_descriptor' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'person_id'       => 2,
                'emp_id'          => 'EMP-2024-002',
                'hire_date'       => '2024-02-01',
                'status'          => 'active',
                'face_descriptor' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'person_id'       => 3,
                'emp_id'          => 'EMP-2023-010',
                'hire_date'       => '2023-06-10',
                'status'          => 'active',
                'face_descriptor' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'person_id'       => 4,
                'emp_id'          => 'EMP-2024-003',
                'hire_date'       => '2024-03-20',
                'status'          => 'active',
                'face_descriptor' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'person_id'       => 5,
                'emp_id'          => 'EMP-2024-004',
                'hire_date'       => '2024-04-05',
                'status'          => 'inactive',
                'face_descriptor' => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ];

        DB::table('employees')->insert($employees);
    }
}
