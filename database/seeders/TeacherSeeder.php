<?php

namespace Database\Seeders;

use App\Models\Users\Staff;
use Illuminate\Database\Seeder;
use App\Models\Users\Teacher;
use App\Models\Users\User;
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
            'address' => '456 Teacher Avenue, Kano',
            'religion' => 'Christianity',
            'tribe' => 'Yoruba',
        ]);

        $staff = Staff::create([
            'user_id' => $user->id,
            'staff_number' =>  Staff::generateStaffNumber(),
            'staff_type' => 'teacher',
            'employment_date' => now(),
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'staff_id' => $staff->id,
            'specialized_subject' => 'Mathematics',
            'highest_qualification' => 'M.Sc',
            'years_of_experience' => 8,
            'start_date' => now(),
            'employment_type' => 'full_time',
        ]);
        $user->update(['password' => $staff->staff_number]);

        // Seed random teachers with factories
        Teacher::factory()->count(10)->create();
    }
}
