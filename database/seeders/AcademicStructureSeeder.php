<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Academic\Program;
use App\Models\Academic\ClassLevel;
use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Users\Teacher;

class AcademicStructureSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = Teacher::all();

        $data = [
            'General' => [
                'description' => 'Standard academic program for science, arts and commercial studies.',
                'levels' => [
                    'Nursery' => [
                        'classes' => ['Nursery 1', 'Nursery 2', 'Nursery 3'],
                        'description' => 'Early childhood education foundation.'
                    ],
                    'Primary' => [
                        'classes' => [
                            'Primary 1',
                            'Primary 2',
                            'Primary 3',
                            'Primary 4',
                            'Primary 5',
                            'Primary 6',
                        ],
                        'description' => 'Basic education stage for fundamental learning.'
                    ],
                    'JSS' => [
                        'classes' => ['JSS 1', 'JSS 2', 'JSS 3'],
                        'description' => 'Junior Secondary School.'
                    ],
                    'SSS' => [
                        'classes' => ['SSS 1', 'SSS 2', 'SSS 3'],
                        'description' => 'Senior Secondary School'
                    ],
                ],
                'arms' => ['A', 'B', 'C'],
            ],

            'Islamiyya' => [
                'description' => 'Islamic studies program covering Qur’an, Arabic and Hadith.',
                'levels' => [
                    'Basic' => [
                        'classes' => ['Basic 1', 'Basic 2', 'Basic 3'],
                    ],
                    'Intermediate' => [
                        'classes' => ['Level 1', 'Level 2', 'Level 3'],
                    ],
                    'Advanced' => [
                        'classes' => ['Hifz 1', 'Hifz 2', 'Hifz 3'],
                    ],
                ],
                'arms' => [
                    'Khulafa Rashidun' => [
                        'Abu Bakr As-Siddiq',
                        'Umar ibn Al-Khattab',
                        'Uthman ibn Affan',
                        'Ali ibn Abi Talib',
                    ],
                    'Wives of the Prophet' => [
                        'Khadijah bint Khuwaylid',
                        'Aisha bint Abu Bakr',
                        'Hafsa bint Umar',
                        'Umm Salama',
                    ],
                    'Companions' => [
                        'Abu Hurairah',
                        'Bilal ibn Rabah',
                        'Saad ibn Abi Waqqas',
                        'Abdullah ibn Masud',
                        'Anas ibn Malik',
                    ],
                    'Prophets Children' => [
                        'Al-Qasim ibn Muhammad',
                        'Abdullah ibn Muhammad',
                        'Ibrahim ibn Muhammad',
                    ],
                    'Tafsir Group' => [
                        'Tafsir Al-Quran',
                        'Hadith Studies',
                        'Fiqh Studies',
                    ],
                ],
            ],
        ];

        foreach ($data as $programName => $programData) {

            $program = Program::create([
                'name' => $programName,
                'description' => $programData['description'],
                'is_default' => $programName === 'General',
                'is_active' => true,
            ]);

            foreach ($programData['levels'] as $levelName => $levelData) {

                $level = ClassLevel::create([
                    'program_id' => $program->id,
                    'name' => $levelName,
                    'description' => $levelData['description']
                        ?? "{$levelName} level of {$programName} program",
                ]);

                /*
                |--------------------------------------------------------------------------
                | CREATE CLASSES
                |--------------------------------------------------------------------------
                */

                $createdClasses = collect();

                foreach ($levelData['classes'] as $className) {

                    $createdClasses->push(
                        AcademicClass::create([
                            'program_id' => $program->id,
                            'class_level_id' => $level->id,
                            'name' => $className,
                            'is_active' => true,
                        ])
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | LINK NEXT CLASS (FIXED)
                |--------------------------------------------------------------------------
                */

                foreach ($createdClasses as $index => $class) {

                    $next = $createdClasses[$index + 1] ?? null;

                    if ($next) {
                        $class->update([
                            'next_class_id' => $next->id
                        ]);
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | CREATE ARMS
                |--------------------------------------------------------------------------
                */

                foreach ($createdClasses as $class) {

                    $armPool = $programName === 'General'
                        ? ['A', 'B', 'C']
                        : collect($programData['arms'])
                        ->flatMap(fn($group) => $group)
                        ->shuffle()
                        ->unique()
                        ->take(3)
                        ->values()
                        ->toArray();

                    foreach ($armPool as $armName) {

                        ClassArm::create([
                            'class_id' => $class->id,
                            'name' => $armName,
                            'teacher_id' => $teachers->isNotEmpty()
                                ? $teachers->random()->user_id
                                : null,
                            'capacity' => rand(20, 40),
                            'is_active' => true,
                        ]);
                    }
                }
            }
        }
    }
}
