<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicantDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $applicant_documents = [
            [
                'application_id' => 1,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 1,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 2,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 2,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 3,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 3,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 4,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 4,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 5,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 5,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 6,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 6,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 7,
                'type' => 'Resume',
                'file_path' => 'uploads/rf0hma0NGHDEBQVJO6EqLdah7KmLgpqOcSurVDRC.docx',
                'created_at' => now(),
            ],
            [
                'application_id' => 7,
                'type' => 'Certificate',
                'file_path' => 'uploads/PSlJvBlSSPT8bM7sAphKq3bVaJTo5uMe2hQcXekj.docx',
                'created_at' => now(),
            ],
        ];

        DB::table('application_documents')->insert($applicant_documents);
    }
}
