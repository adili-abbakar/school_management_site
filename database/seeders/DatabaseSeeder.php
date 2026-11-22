<?php

namespace Database\Seeders;

use App\Models\Users\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            // AdminSeeder::class,
            // TeacherSeeder::class,
            // AcademicClassSeeder::class,
            // AcademicSessionSeeder::class,
            // StudentApplicationSeeder::class,

            NumberingSettingSeeder::class,
            UserSeeder::class,
            AcademicStructureSeeder::class,
            SessionTermSeeder::class,
        ]);
    }
}
