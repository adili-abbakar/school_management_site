<?php

namespace Database\Factories\Users;

use App\Models\Users\Staff;
use App\Models\Users\User;
use App\Models\Users\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        $staffNumber =  Staff::generateStaffNumber();

        $user = User::factory(['password' => Hash::make($staffNumber),])->create();

        $staff = Staff::create([
            'user_id' => $user->id,
            'staff_number' =>  $staffNumber,
            'staff_type' => 'teacher',
            'employment_date' => now(),
        ]);

        return [
            'user_id' => $user->id,
            'staff_id' => $staff->id,
            'specialized_subject' => $this->faker->randomElement(['Mathematics', 'English', 'Physics', 'Biology']),
            'highest_qualification' => $this->faker->randomElement(['B.Sc', 'M.Sc', 'PhD']),
            'years_of_experience' => $this->faker->numberBetween(1, 25),
            'start_date' => $this->faker->date(),
            'employment_type' => $this->faker->randomElement(['full_time', 'part_time', 'contract']),
        ];
    }
}
