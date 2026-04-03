<?php

namespace App\Models\Academic;

use Illuminate\Cache\Events\RetrievingKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AcademicClass extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'level',
        'next_class_id'
    ];


    public function nextClass(): BelongsTo
    {
        return $this->belongsTo(self::class, 'next_class_id');
    }

    public function arms(): HasMany
    {
        return $this->hasMany(ClassArm::class, 'class_id');
    }

    public function teachersCount(): int
    {
        return $this->arms()
            ->whereNotNull('teacher_id')
            ->distinct('teacher_id')
            ->count('teacher_id');
    }


    public function previousClass(): HasOne
    {
        return $this->hasOne(self::class, 'next_class_id', 'id');
    }


    public function wouldCreateCycle(AcademicClass $previousClass): bool
    {
        $visited = [];
        $current = $this; // start from current class

        while ($current) {
            // If we reach the previous class → cycle
            if ($current->id === $previousClass->id) {
                return true;
            }

            // safety check
            if (in_array($current->id, $visited)) {
                break;
            }

            $visited[] = $current->id;

            // move forward
            $current = $current->nextClass;
        }


        return false;
    }

    public static function orderdChain()
    {
        $chains  = collect();
        $visited = [];

        $heads = self::whereDoesntHave('previousClass')->get();

        foreach ($heads as $head) {
            $current = $head;
            $chain = collect();

            while ($current) {
                if (in_array($current->id, $visited)) {
                    break;
                }
                $visited[] = $current->id;
                $chain->push($current);
                $current = $current->nextClass;
            }
            $chains->push($chain);
        }

        $orphans = self::whereNotIn('id', $visited)->get();
        foreach($orphans as $orphan){
            $chains->push(collect([$orphan]));
        }

        return $chains;
    }
}
