<?php

namespace Database\Seeders;

use App\Models\Academic\Session;
use App\Models\Academic\Term;
use Illuminate\Database\Seeder;

class SessionTermSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = [
            [
                'name' => '2024/2025',
                'start_date' => '2024-09-09',
                'end_date' => '2025-07-25',
                'terms' => [
                    [
                        'name' => 'First Term',
                        'start_date' => '2024-09-09',
                        'end_date' => '2024-12-13',
                        'activity' => 'completed',
                    ],
                    [
                        'name' => 'Second Term',
                        'start_date' => '2025-01-06',
                        'end_date' => '2025-04-04',
                        'activity' => 'completed',
                    ],
                    [
                        'name' => 'Third Term',
                        'start_date' => '2025-04-28',
                        'end_date' => '2025-07-25',
                        'activity' => 'completed',
                    ],
                ]
            ],

            [
                'name' => '2025/2026',
                'start_date' => '2025-09-08',
                'end_date' => '2026-07-24',
                'terms' => [
                    [
                        'name' => 'First Term',
                        'start_date' => '2025-09-08',
                        'end_date' => '2025-12-12',
                        'activity' => 'completed',
                    ],
                    [
                        'name' => 'Second Term',
                        'start_date' => '2026-01-05',
                        'end_date' => '2026-04-03',
                        'activity' => 'completed',
                    ],
                    [
                        'name' => 'Third Term',
                        'start_date' => '2026-04-27',
                        'end_date' => '2026-07-24',
                        'activity' => 'completed',
                    ],
                ]
            ],

            [
                'name' => '2026/2027',
                'start_date' => '2026-09-14',
                'end_date' => '2027-07-30',
                'terms' => [
                    [
                        'name' => 'First Term',
                        'start_date' => '2026-09-14',
                        'end_date' => '2026-12-18',
                        'activity' => 'active',
                    ],
                    [
                        'name' => 'Second Term',
                        'start_date' => '2027-01-11',
                        'end_date' => '2027-04-09',
                        'activity' => 'upcoming',
                    ],
                    [
                        'name' => 'Third Term',
                        'start_date' => '2027-04-26',
                        'end_date' => '2027-07-30',
                        'activity' => 'upcoming',
                    ],
                ]
            ],
        ];

        foreach ($sessions as $sessionData) {

            $terms = $sessionData['terms'];

            unset($sessionData['terms']);

            $session = Session::create($sessionData);

            foreach ($terms as $termData) {

                Term::create([
                    ...$termData,
                    'session_id' => $session->id,
                ]);
            }
        }
    }
}