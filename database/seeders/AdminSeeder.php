<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users\Admin;
use App\Models\Users\Staff;
use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    
    public function run()
    {
        $user = User::create([
            'first_name' => 'Super',
            'middle_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@school.com',
            'password' => Hash::make('12345678'),
            'phone' => '08012345678',
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'nationality' => 'Nigeria',
            'state' => 'Sokoto',
            'local_government' => 'Sokoto North',
            'address' => '123 Admin Street, Ariklla',
            'religion' => 'Islam',
            'tribe' => 'Hausa',
        ]);

        $staff = Staff::create([
            'user_id' => $user->id,
            'staff_number' =>  Staff::generateStaffNumber(),
            'staff_type' => 'admin',
            'employment_date' => now(),
        ]);

        Admin::create([
            'user_id' => $user->id,
            'staff_id' => $staff->id,
            'role_type' => 'super_admin',
            'highest_qualification' => 'PhD',
            'years_of_experience' => 10,
            'start_date' => now(),
            'employment_type' => 'full_time',
        ]);

        $user->update(['password' => $staff->staff_number]);
        // Seed random admins with factories
        Admin::factory()->count(10)->create();
    }
}
