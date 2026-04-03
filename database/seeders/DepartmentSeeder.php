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
                'details'    => 'Handles recruitment, employee relations, and company policies. Responsible for developing and implementing HR strategies that support organizational goals, managing talent acquisition, performance management, training and development programs, employee engagement initiatives, conflict resolution, compliance with labor laws, and fostering a positive workplace culture that promotes productivity and employee satisfaction.',
                'icon'       => 'ri-team-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name'  => 'Information Technology',
                'details'    => 'Manages company systems, software development, and IT infrastructure. Ensures that all technology resources are secure, reliable, and efficiently supporting business operations. Tasks include maintaining networks and servers, implementing cybersecurity protocols, developing internal applications, providing technical support, overseeing IT projects, integrating new technologies, and continuously optimizing the IT environment to improve productivity and innovation across all departments.',
                'icon'       => 'ri-computer-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name'  => 'Finance',
                'details'    => 'Oversees budgeting, payroll, accounting, and financial reporting. Responsible for strategic financial planning, cash flow management, risk assessment, auditing, tax compliance, financial forecasting, investment management, and providing management with accurate reports to inform decision-making. This department ensures the company’s financial health, regulatory compliance, and alignment of financial resources with overall business objectives.',
                'icon'       => 'ri-team-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name'  => 'Operations',
                'details'    => 'Responsible for day-to-day business operations and logistics. Focuses on streamlining processes, supply chain management, resource allocation, production planning, quality control, and monitoring operational performance. Works closely with other departments to ensure smooth workflow, efficiency, and cost-effectiveness, while implementing strategies to enhance productivity, reduce bottlenecks, and achieve long-term operational excellence.',
                'icon'       => 'ri-settings-2-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}
