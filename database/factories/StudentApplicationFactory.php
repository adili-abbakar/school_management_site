<?php

namespace Database\Factories;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\Session;
use App\Models\Academic\Term;
use App\Models\StudentApplication;
use App\Models\Users\Guardian;
use App\Models\Users\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentApplicationFactory extends Factory
{

    public function definition(): array
    {
        $submittedByUserId = $this->getRandomSubmitterUserId();

        return [
            // STUDENT DATA
            'student_first_name' => fake()->firstName(),
            'student_middle_name' => fake()->firstName(),
            'student_last_name' => fake()->optional()->lastName(),
            'student_date_of_birth' => fake()
                ->dateTimeBetween('-18 years', '-3 years')
                ->format('Y-m-d'),
            'student_gender' => fake()->randomElement(['male', 'female']),
            'student_nationality' => 'Nigeria',
            'student_state' => fake()->randomElement([
                'Kano',
                'Kaduna',
                'Sokoto',
                'Katsina',
                'Lagos',
                'Oyo',
                'Abuja',
                'Zamfara',
            ]),
            'student_local_government' => fake()->city(),
            'student_religion' => fake()->randomElement(['Islam', 'Christianity']),
            'student_tribe' => fake()->randomElement([
                'Hausa',
                'Yoruba',
                'Igbo',
                'Fulani',
                'Nupe',
            ]),
            'student_address' => fake()->address(),

            // GUARDIAN DATA
            'guardian_first_name' => fake()->firstName(),
            'guardian_middle_name' => fake()->firstName(),
            'guardian_last_name' => fake()->optional()->lastName(),
            'guardian_phone' => fake()->unique()->numerify('080########'),
            'guardian_email' => fake()->unique()->safeEmail(),
            'guardian_date_of_birth' => fake()
                ->dateTimeBetween('-65 years', '-25 years')
                ->format('Y-m-d'),
            'guardian_gender' => fake()->randomElement(['male', 'female']),
            'guardian_nationality' => 'Nigeria',
            'guardian_state' => fake()->randomElement([
                'Kano',
                'Kaduna',
                'Sokoto',
                'Katsina',
                'Lagos',
                'Oyo',
                'Abuja',
                'Zamfara',
            ]),
            'guardian_local_government' => fake()->city(),
            'guardian_religion' => fake()->randomElement(['Islam', 'Christianity']),
            'guardian_tribe' => fake()->randomElement([
                'Hausa',
                'Yoruba',
                'Igbo',
                'Fulani',
                'Nupe',
            ]),
            'guardian_address' => fake()->address(),
            'guardian_occupation' => fake()->jobTitle(),
            'guardian_relationship' => fake()->randomElement([
                'father',
                'mother',
                'brother',
                'sister',
                'grandfather',
                'grandmother',
                'uncle',
                'aunt',
                'other',
            ]),

            // APPLICATION META
            'application_number' => StudentApplication::generateApplicationNumber(),
            'previous_school_name' => fake()->optional(0.7)->company(),
            'last_class_attended' => fake()->optional(0.7)->randomElement([
                'Nursery 1',
                'Nursery 2',
                'Nursery 3',
                'Primary 1',
                'Primary 2',
                'Primary 3',
                'Primary 4',
                'Primary 5',
                'Primary 6',
                'JSS 1',
                'JSS 2',
                'JSS 3',
                'SS 1',
                'SS 2',
            ]),
            'class_id' => $this->getRandomClassId(),
            'stream' => fake()->randomElement(['arts', 'science', 'general']),
            'session_id' => $this->getCurrentSessionId(),
            'status' => fake()->randomElement([
                'pending',
            ]),

            'submitted_by_user_id' => $submittedByUserId,
        ];
    }

    private function getRandomSubmitterUserId(): ?int
    {
        $submitterType = fake()->randomElement([
            'staff',
            'existing_guardian',
            'public',
        ]);

        if ($submitterType === 'staff') {
            return Staff::query()
                ->inRandomOrder()
                ->value('user_id');
        }

        if ($submitterType === 'existing_guardian') {
            return Guardian::query()
                ->inRandomOrder()
                ->value('user_id');
        }

        return null;
    }

    private function getRandomClassId(): ?int
    {
        return AcademicClass::query()
            ->inRandomOrder()
            ->value('id');
    }

    private function getCurrentSessionId(): ?int
    {
        return Term::query()
            ->where('activity', 'active')
            ->value('session_id')
            ?? Session::query()->latest('id')->value('id');
    }

    public function publicApplicant(): static
    {
        return $this->state(fn () => [
            'submitted_by_user_id' => null,
        ]);
    }

    public function byStaff(): static
    {
        return $this->state(fn () => [
            'submitted_by_user_id' => Staff::query()
                ->inRandomOrder()
                ->value('user_id'),
        ]);
    }

    public function byGuardian(): static
    {
        return $this->state(fn () => [
            'submitted_by_user_id' => Guardian::query()
                ->inRandomOrder()
                ->value('user_id'),
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => 'pending',
        ]);
    }

    public function approved(): static
    {
        return $this->state(fn () => [
            'status' => 'approved',
        ]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => [
            'status' => 'rejected',
        ]);
    }

    public function withdrawn(): static
    {
        return $this->state(fn () => [
            'status' => 'withdrawn',
        ]);
    }

    public function science(): static
    {
        return $this->state(fn () => [
            'stream' => 'science',
        ]);
    }

    public function arts(): static
    {
        return $this->state(fn () => [
            'stream' => 'arts',
        ]);
    }

    public function general(): static
    {
        return $this->state(fn () => [
            'stream' => 'general',
        ]);
    }
}
