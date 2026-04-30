<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NumberingSetting extends Model
{
    /** @use HasFactory<\Database\Factories\NumberingSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'prefix',
        'separator',
        'include_year',
        'padding',
        'next_number'
    ];


    public static function generateUnique(string $type, string $modelClass, string $column): string
    {
        return DB::transaction(function () use ($type, $modelClass, $column) {
            $setting = self::where('type', $type)
                ->lockForUpdate()
                ->firstOrFail();

            do {
                $parts = [];

                if ($setting->prefix) {
                    $parts[] = $setting->prefix;
                }

                if ($setting->include_year) {
                    $parts[] = now()->year;
                }

                $parts[] = str_pad(
                    $setting->next_number,
                    $setting->padding,
                    '0',
                    STR_PAD_LEFT
                );

                $number = implode($setting->separator, $parts);

                $exists = $modelClass::where($column, $number)->exists();

                $setting->next_number++;
            } while ($exists);

            $setting->save();

            return $number;
        });
    }
}
