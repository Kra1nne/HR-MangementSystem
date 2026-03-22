<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $persons = [
            [
                'firstname'   => 'Juan',
                'lastname'    => 'Dela Cruz',
                'middlename'   => 'Santos',
                'address'     => '123 Rizal St, Cebu City',
                'phone_number'=> '09171234567',
                'birth_date'  => '1990-05-14',
                'sex'         => 'Male',
                'blood_type'  => 'O+',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'firstname'   => 'Maria',
                'lastname'    => 'Reyes',
                'middlename'   => 'Garcia',
                'address'     => '456 Mabini Ave, Cebu City',
                'phone_number'=> '09189876543',
                'birth_date'  => '1993-08-22',
                'sex'         => 'Female',
                'blood_type'  => 'A+',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'firstname'   => 'Carlos',
                'lastname'    => 'Mendoza',
                'middlename'   => 'Lopez',
                'address'     => '789 Osmena Blvd, Mandaue City',
                'phone_number'=> '09204567890',
                'birth_date'  => '1988-11-03',
                'sex'         => 'Male',
                'blood_type'  => 'B+',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'firstname'   => 'Ana',
                'lastname'    => 'Torres',
                'middlename'   => 'Villanueva',
                'address'     => '321 Colon St, Cebu City',
                'phone_number'=> '09351122334',
                'birth_date'  => '1995-02-17',
                'sex'         => 'Female',
                'blood_type'  => 'AB+',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'firstname'   => 'Roberto',
                'lastname'    => 'Navarro',
                'middlename'   => 'Castillo',
                'address'     => '654 Gen. Maxilom Ave, Cebu City',
                'phone_number'=> '09162233445',
                'birth_date'  => '1985-07-30',
                'sex'         => 'Male',
                'blood_type'  => 'O-',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('persons')->insert($persons);
    }
}
