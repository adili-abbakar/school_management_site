<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            NumberingSettingSeeder::class,
            AdminSeeder::class,
            TeacherSeeder::class
        ]);
    }
}
