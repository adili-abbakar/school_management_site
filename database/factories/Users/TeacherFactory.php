<?php
namespace Database\Factories\Users;

use App\Models\Users\User;
use App\Models\Users\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'staff_number' => strtoupper($this->faker->unique()->bothify('TCH###')),
            'specialized_subject' => $this->faker->randomElement(['Mathematics', 'English', 'Physics', 'Biology']),
            'highest_qualification' => $this->faker->randomElement(['B.Sc', 'M.Sc', 'PhD']),
            'years_of_experience' => $this->faker->numberBetween(1, 25),
            'start_date' => $this->faker->date(),
            'employment_type' => $this->faker->randomElement(['full_time', 'part_time', 'contract']),
        ];
    }
}

