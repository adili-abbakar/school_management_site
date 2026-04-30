<?php

namespace Database\Factories\Users;

use App\Models\Users\User;
use App\models\Users\Admin;
use App\Models\Users\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $user = User::factory()->create();

        $staff = Staff::create([
            'user_id' => $user->id,
            'staff_number' =>  Staff::generateStaffNumber(),
            'staff_type' => 'admin',
            'employment_date' => now(),
        ]);
        $user->update(['password' => $staff->staff_number]);

        return [
            'user_id' => $user->id,
            'staff_id' => $staff->id,
            'role_type' => $this->faker->randomElement(['super_admin', 'exam_officer', 'admission_officer']),
            'highest_qualification' => $this->faker->randomElement(['B.Sc', 'M.Sc', 'PhD']),
            'years_of_experience' => $this->faker->numberBetween(1, 30),
            'start_date' => $this->faker->date(),
            'employment_type' => $this->faker->randomElement(['full_time', 'part_time', 'contract']),
        ];
    }
}
