<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'dept_no' => 2,
                'created_by' => 1,
                'job_title' => 'Software Engineer',
                'description' => 'Design, develop, and maintain scalable backend systems and APIs to support web and mobile applications. Collaborate with frontend developers, QA engineers, and product managers to deliver high-quality software solutions. Optimize application performance, troubleshoot issues, and ensure system security and data integrity. Participate in code reviews and contribute to continuous improvement of development processes.',
                'objectives' => 'Develop and maintain scalable backend services and APIs
                Improve system performance, security, and reliability
                Collaborate effectively with cross-functional development teams
                Ensure clean, maintainable, and well-documented code',
                'requirements' => 'Bachelor’s degree in Computer Science or related field. 
                At least 2–4 years of experience in backend development. 
                Proficiency in Node.js, PHP (Laravel), or similar frameworks. 
                Strong understanding of RESTful APIs, database management (MySQL/PostgreSQL), and version control systems (Git). 
                Familiarity with cloud services and basic DevOps practices is an advantage. Strong problem-solving skills and ability to work in a team environment.',
                'salary' => 60000,
                'position' => 'Backend Developer',
                'employment_type' => 'Full-time',
                'work_setup' => 'On-site',
                'location' => 'Cebu, Philippines',
                'status' => 'open',
                'closing_date' => '2026-08-30',
                'created_at' => now()
            ],

            // SAMPLE 2
            [
                'dept_no' => 2,
                'created_by' => 1,
                'job_title' => 'Frontend Developer',
                'description' => 'Develop responsive and user-friendly web interfaces using modern frontend frameworks. Work closely with UI/UX designers to implement visually appealing designs. Optimize applications for maximum speed and scalability while ensuring cross-browser compatibility.',
                'objectives' => 'Build responsive and interactive user interfaces
                Collaborate with designers and backend developers
                Improve application performance and usability
                Maintain clean and reusable code',
                'requirements' => 'Bachelor’s degree in IT or related field.
                At least 2 years of experience in frontend development.
                Proficiency in HTML, CSS, JavaScript, and frameworks like React or Vue.
                Experience with REST APIs and Git version control.
                Strong attention to detail and problem-solving skills.',
                'salary' => 50000,
                'position' => 'Frontend Developer',
                'employment_type' => 'Full-time',
                'work_setup' => 'Hybrid',
                'location' => 'Quezon City, Philippines',
                'status' => 'draft',
                'closing_date' => '2026-08-15',
                'created_at' => now()
            ],

            // SAMPLE 3
            [
                'dept_no' => 2,
                'created_by' => 1,
                'job_title' => 'UI/UX Designer',
                'description' => 'Design intuitive and engaging user experiences for web and mobile applications. Conduct user research, create wireframes and prototypes, and collaborate with developers to ensure proper implementation of designs.',
                'objectives' => 'Create user-centered designs based on research
                Develop wireframes, prototypes, and design systems
                Enhance usability and user satisfaction
                Collaborate with cross-functional teams',
                'requirements' => 'Bachelor’s degree in Design, IT, or related field.
                At least 1–3 years of experience in UI/UX design.
                Proficiency in Figma, Adobe XD, or similar tools.
                Strong portfolio demonstrating design projects.
                Good communication and teamwork skills.',
                'salary' => 45000,
                'position' => 'UI/UX Designer',
                'employment_type' => 'Full-time',
                'work_setup' => 'Remote',
                'location' => 'Manila, Philippines',
                'status' => 'draft',
                'closing_date' => '2026-08-01',
                'created_at' => now()
            ],
        ];

        DB::table('job_postings')->insert($jobs);
    }
}
