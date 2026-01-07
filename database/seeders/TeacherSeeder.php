<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        // Seed a fixed teacher for guaranteed login
        $user = User::create([
            'first_name' => 'John',
            'middle_name' => 'Test',
            'last_name' => 'Teacher',
            'email' => 'teacher@school.com',
            'password' => Hash::make('12345678'),
            'phone' => '08098765432',
            'date_of_birth' => '1985-05-15',
            'gender' => 'female',
            'nationality' => 'Nigeria',
            'state' => 'Kano',
            'local_government' => 'Nassarawa',
            'type' => 'teacher',
            'address' => '456 Teacher Avenue, Kano',
            'religion' => 'Christianity',
            'tribe' => 'Yoruba',
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'staff_number' => 'TCH001',
            'specialized_subject' => 'Mathematics',
            'highest_qualification' => 'M.Sc',
            'years_of_experience' => 8,
            'start_date' => now(),
            'employment_type' => 'full_time',
        ]);

        // Seed random teachers with factories
        Teacher::factory()->count(10)->create();
    }
}
