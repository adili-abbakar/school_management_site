<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users\Admin;
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
            'state' => 'Lagos',
            'local_government' => 'Ikeja',
            'type' => 'admin',
            'address' => '123 Admin Street, Lagos',
            'religion' => 'Islam',
            'tribe' => 'Hausa',
        ]);

        Admin::create([
            'user_id' => $user->id,
            'staff_number' => 'ADM001',
            'role_type' => 'super_admin',
            'highest_qualification' => 'PhD',
            'years_of_experience' => 10,
            'start_date' => now(),
            'employment_type' => 'full_time',
        ]);

        // Seed random admins with factories
        Admin::factory()->count(10)->create();
    }
}
