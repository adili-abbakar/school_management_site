<?php

namespace Database\Seeders;

use App\Models\StudentApplication;
use Illuminate\Database\Seeder;

class StudentApplicationSeeder extends Seeder
{
    public function run(): void
    {
        StudentApplication::factory()
            ->count(30)
            ->create();

        StudentApplication::factory()
            ->count(10)
            ->publicApplicant()
            ->pending()
            ->create();

        StudentApplication::factory()
            ->count(5)
            ->byStaff()
            ->approved()
            ->create();

        StudentApplication::factory()
            ->count(5)
            ->byGuardian()
            ->pending()
            ->create();
    }
}
