<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Academic\AcademicClass;
use App\Models\Academic\ClassArm;
use App\Models\Users\Teacher;

class AcademicClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $model = AcademicClass::class;
    public function run(): void
    {
        $teachers = Teacher::pluck('user_id')->all();

        $classDefinitions = [];

        foreach (range(1, 3) as $i) {
            $classDefinitions[] = ['name' => "Nursery $i", 'level' => 'nursery'];
        }

        foreach (range(1, 6) as $i) {
            $classDefinitions[] = ['name' => "Primary $i", 'level' => 'primary'];
        }

        foreach (range(1, 3) as $i) {
            $classDefinitions[] = ['name' => "JSS $i", 'level' => 'jss'];
        }

        foreach (range(1, 3) as $i) {
            $classDefinitions[] = ['name' => "SS $i", 'level' => 'sss'];
        }

        $classes = [];
        foreach ($classDefinitions as $def) {
            $classes[] = AcademicClass::create($def);
        }

        for ($i = 0; $i < count($classes) - 1; $i++) {
            $classes[$i]->update(['next_class_id' => $classes[$i + 1]->id]);
        }

        foreach ($classes as $class) {
            if ($class->level === 'sss') {
                foreach (['Arts', 'Sciences'] as $armName) {
                    ClassArm::create([
                        'class_id' => $class->id,
                        'name' => $armName,
                        'teacher_id' => !empty($teachers) ? collect($teachers)->random() : null,
                    ]);
                }
            } else {
                foreach (['A', 'B', 'C'] as $armName) {
                    ClassArm::create([
                        'class_id' => $class->id,
                        'name' => $armName,
                        'teacher_id' => !empty($teachers) ? collect($teachers)->random() : null,
                    ]);
                }
            }
        }


    }
}
