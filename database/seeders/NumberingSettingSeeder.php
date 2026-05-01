<?php

namespace Database\Seeders;

use App\Models\NumberingSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NumberingSetting::create([
            'type'  => 'staff_id',
            'prefix' => "STF",
            'separator' => '',
            'padding' => 3,
        ]);

        NumberingSetting::create([
            'type'  => 'application_number',
            'prefix' => "APP",
            'separator' => '-',
            'padding' => 4,
        ]);


        NumberingSetting::create([
            'type'  => 'admission_number',
            'prefix' => "ADM",
            'separator' => '',
            'padding' => 3,
        ]);
    }
}
