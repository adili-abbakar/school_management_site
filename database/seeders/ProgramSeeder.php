<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Academic\Program;
use App\Models\Academic\ClassLevel;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'name' => 'General',
                'description' => 'Standard academic program covering science, arts, and commercial subjects.',
                'is_default' => true,
                'levels' => [
                    [
                        'name' => 'Nursery',
                        'description' => 'Early childhood education foundation.'
                    ],
                    [
                        'name' => 'Primary',
                        'description' => 'Basic education stage for fundamental learning.'
                    ],
                    [
                        'name' => 'JSS1',
                        'description' => 'Junior Secondary School first year.'
                    ],
                    [
                        'name' => 'JSS2',
                        'description' => 'Junior Secondary School second year.'
                    ],
                    [
                        'name' => 'JSS3',
                        'description' => 'Junior Secondary School final year.'
                    ],
                    [
                        'name' => 'SS1',
                        'description' => 'Senior Secondary School first year.'
                    ],
                    [
                        'name' => 'SS2',
                        'description' => 'Senior Secondary School second year.'
                    ],
                    [
                        'name' => 'SS3',
                        'description' => 'Senior Secondary School final year.'
                    ],
                ]
            ],

            [
                'name' => 'Islamiyya',
                'description' => 'Islamic education program focusing on Qur\'an, Arabic, and Islamic studies.',
                'levels' => [
                    [
                        'name' => 'Basic 1',
                        'description' => 'Introduction to Arabic letters and basic Islamic studies.'
                    ],
                    [
                        'name' => 'Basic 2',
                        'description' => 'Continuation of foundational Arabic and Islamic knowledge.'
                    ],
                    [
                        'name' => 'Basic 3',
                        'description' => 'Preparation for intermediate Islamic learning.'
                    ],
                    [
                        'name' => 'Hifz 1',
                        'description' => 'Start of Qur\'an memorization stage.'
                    ],
                    [
                        'name' => 'Hifz 2',
                        'description' => 'Intermediate Qur\'an memorization and revision.'
                    ],
                    [
                        'name' => 'Hifz 3',
                        'description' => 'Advanced Qur\'an memorization and completion stage.'
                    ],
                ]
            ],
        ];

        foreach ($programs as $programData) {

            $levels = $programData['levels'];
            unset($programData['levels']);

            $program = Program::create($programData);

            foreach ($levels as $level) {
                ClassLevel::create([
                    'program_id' => $program->id,
                    'name' => $level['name'],
                    'description' => $level['description'],
                ]);
            }
        }
    }
}
