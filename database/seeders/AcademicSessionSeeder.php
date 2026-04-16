<?php

namespace Database\Seeders;

use App\Models\Academic\Session;
use App\Models\Academic\Term;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AcademicSessionSeeder extends Seeder
{
    public function run(): void
    {
        $currentYear = now()->year;

        // We want 3 sessions total:
        // currentYear-3/currentYear-2
        // currentYear-2/currentYear-1
        // currentYear-1/currentYear
        for ($endYear = $currentYear - 2; $endYear <= $currentYear; $endYear++) {
            $startYear = $endYear - 1;
            $sessionName = "{$startYear}/{$endYear}";

            $session = Session::updateOrCreate(
                ['name' => $sessionName],
                [
                    'start_date' => Carbon::create($endYear, 1, 1)->toDateString(),
                    'end_date' => Carbon::create($endYear, 12, 31)->toDateString(),
                ]
            );

            $isCurrentSession = $endYear === $currentYear;

            $terms = [
                [
                    'name' => 'First Term',
                    'start_date' => Carbon::create($endYear, 1, 1)->toDateString(),
                    'end_date' => Carbon::create($endYear, 4, 30)->toDateString(),
                    'activity' => $isCurrentSession ? 'active' : 'completed',
                ],
                [
                    'name' => 'Second Term',
                    'start_date' => Carbon::create($endYear, 5, 1)->toDateString(),
                    'end_date' => Carbon::create($endYear, 8, 31)->toDateString(),
                    'activity' => 'upcoming',
                ],
                [
                    'name' => 'Third Term',
                    'start_date' => Carbon::create($endYear, 9, 1)->toDateString(),
                    'end_date' => Carbon::create($endYear, 12, 31)->toDateString(),
                    'activity' => 'upcoming',
                ],
            ];

            // For past sessions, all should be completed
            if (!$isCurrentSession) {
                $terms[1]['activity'] = 'completed';
                $terms[2]['activity'] = 'completed';
            }

            foreach ($terms as $termData) {
                Term::updateOrCreate(
                    [
                        'session_id' => $session->id,
                        'name' => $termData['name'],
                    ],
                    [
                        'start_date' => $termData['start_date'],
                        'end_date' => $termData['end_date'],
                        'activity' => $termData['activity'],
                    ]
                );
            }
        }
    }
}
