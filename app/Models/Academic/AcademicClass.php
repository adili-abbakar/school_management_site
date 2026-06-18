<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicClass extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'class_level_id',
        'next_class_id',
        'section_id',
        'is_active'
    ];

    public function level(){
        return $this->belongsTo(ClassLevel::class, 'class_level_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

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
        $current = $this; 
        while ($current) {
            if ($current->id === $previousClass->id) {
                return true;
            }

            if (in_array($current->id, $visited)) {
                break;
            }

            $visited[] = $current->id;

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
