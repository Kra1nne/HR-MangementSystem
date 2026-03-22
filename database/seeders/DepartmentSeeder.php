<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'dept_name'  => 'Human Resources',
                'details'    => 'Handles recruitment, employee relations, and company policies.',
                'icon'       => 'ri-user-2-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name'  => 'Information Technology',
                'details'    => 'Manages company systems, software development, and IT infrastructure.',
                'icon'       => 'ri-computer-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name'  => 'Finance',
                'details'    => 'Oversees budgeting, payroll, accounting, and financial reporting.',
                'icon'       => 'ri-user-2-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name'  => 'Operations',
                'details'    => 'Responsible for day-to-day business operations and logistics.',
                'icon'       => 'ri-settings-2-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}
