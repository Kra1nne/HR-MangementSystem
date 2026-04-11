<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
        PersonSeeder::class,
        UserSeeder::class,
        EmployeeSeeder::class,
        DepartmentSeeder::class,
        DepartmentEmployeeSeeder::class,
        DepartmentManagerSeeder::class,
        SalarySeeder::class,
        TitleSeeder::class,
        EmployeeLogSeeder::class,
        JobPostingSeeder::class,
    ]);
  }
}
