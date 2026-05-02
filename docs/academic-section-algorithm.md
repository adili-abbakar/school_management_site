# Academic Section System Algorithm

## Purpose

This system supports schools that may have one or many academic sections.

Examples:

- General Section
- Western Education Section
- Islamiyya Section
- Tahfiz Section
- Arabic Section

Each section can have its own:

- Classes
- Class arms
- Sessions
- Terms
- Subjects
- Fees
- Results
- Promotion flow

A student can belong to one section or many sections at the same time.

Example:

Ahmad Musa can be enrolled in:

- Western Education -> JSS 1 -> JSS 1A
- Islamiyya -> Qur'an Level 2 -> Group B

The student is one person, but his academic enrollments can be many.

---

## Main Design Rule

Do not store only one section, class, or arm directly on the students table.

Wrong design:

students
- section_id
- class_id
- arm_id

Correct design:

students
- personal student information only

student_section_enrollments
- student_id
- section_id
- current_class_id
- current_class_arm_id

This allows one student to be in many sections.

---

## Database Tables Needed

Use these tables:

1. sections
2. sessions
3. section_sessions
4. terms
5. academic_classes
6. class_arms
7. students
8. student_section_enrollments
9. subjects
10. student_class_records
11. student_term_records
12. results

---

## Table Meaning

sections:
Stores school sections like General, Western Education, Islamiyya, Tahfiz.

sessions:
Stores academic years like 2025/2026, 2026/2027.

section_sessions:
Connects a section to a session.
This allows every section to progress separately.

Example:
Western Education -> 2025/2026 -> ongoing
Islamiyya -> 2025/2026 -> pending

terms:
Terms belong to section_sessions.
This allows each section to have its own terms.

Example:
Western Education 2025/2026 -> First Term
Islamiyya 2025/2026 -> Ramadan Term

academic_classes:
Classes belong to sections.

Example:
Western Education -> JSS 1
Islamiyya -> Qur'an Level 1

class_arms:
Class arms belong to academic classes.

Example:
JSS 1 -> A
JSS 1 -> B
Qur'an Level 1 -> Group A

students:
Stores only student personal information.

student_section_enrollments:
Stores the student’s current academic placement in each section.

subjects:
Subjects belong to sections.

student_class_records:
Stores a student’s session/year record in one section.

student_term_records:
Stores a student’s term record.

results:
Stores subject results.

---

## Relationship Structure

School
└── Sections
    ├── Academic Classes
    │   └── Class Arms
    ├── Section Sessions
    │   └── Terms
    ├── Subjects
    └── Student Section Enrollments
        └── Student Class Records
            └── Student Term Records
                └── Results

---

## Migration Order

Create migrations in this order:

1. create_sections_table
2. create_sessions_table
3. create_section_sessions_table
4. create_terms_table
5. create_academic_classes_table
6. create_class_arms_table
7. create_students_table
8. create_student_section_enrollments_table
9. create_subjects_table
10. create_student_class_records_table
11. create_student_term_records_table
12. create_results_table

---

## Migration 1: sections

Schema::create('sections', function (Blueprint $table) {
    $table->id();

    $table->string('name');
    $table->string('slug')->unique();
    $table->text('description')->nullable();

    $table->boolean('is_default')->default(false);
    $table->boolean('is_active')->default(true);

    $table->timestamps();
    $table->softDeletes();
});

---

## Migration 2: sessions

Schema::create('sessions', function (Blueprint $table) {
    $table->id();

    $table->string('name')->unique();

    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();

    $table->boolean('is_active')->default(true);

    $table->timestamps();
    $table->softDeletes();
});

Important:
Do not use a global ongoing session here.
The current/ongoing status should be controlled by section_sessions.

---

## Migration 3: section_sessions

Schema::create('section_sessions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('section_id')
        ->constrained('sections')
        ->cascadeOnDelete();

    $table->foreignId('session_id')
        ->constrained('sessions')
        ->cascadeOnDelete();

    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();

    $table->enum('status', [
        'pending',
        'ongoing',
        'finished'
    ])->default('pending');

    $table->timestamps();

    $table->unique(['section_id', 'session_id']);
});

Rule:
Only one section_session should be ongoing per section.

---

## Migration 4: terms

Schema::create('terms', function (Blueprint $table) {
    $table->id();

    $table->foreignId('section_session_id')
        ->constrained('section_sessions')
        ->cascadeOnDelete();

    $table->string('name');

    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();

    $table->enum('status', [
        'pending',
        'ongoing',
        'finished'
    ])->default('pending');

    $table->timestamps();
    $table->softDeletes();

    $table->unique(['section_session_id', 'name']);
});

Rule:
Only one term should be ongoing per section_session.

---

## Migration 5: academic_classes

Schema::create('academic_classes', function (Blueprint $table) {
    $table->id();

    $table->foreignId('section_id')
        ->constrained('sections')
        ->cascadeOnDelete();

    $table->string('name');

    $table->foreignId('next_class_id')
        ->nullable()
        ->constrained('academic_classes')
        ->nullOnDelete();

    $table->integer('sort_order')->default(0);

    $table->boolean('is_graduating_class')->default(false);
    $table->boolean('is_active')->default(true);

    $table->timestamps();
    $table->softDeletes();

    $table->unique(['section_id', 'name']);
});

Meaning:
next_class_id controls promotion.

Example:
Primary 1 -> Primary 2
JSS 1 -> JSS 2
Qur'an Level 1 -> Qur'an Level 2

If next_class_id is null or is_graduating_class is true, the student can graduate from that section.

---

## Migration 6: class_arms

Schema::create('class_arms', function (Blueprint $table) {
    $table->id();

    $table->foreignId('class_id')
        ->constrained('academic_classes')
        ->cascadeOnDelete();

    $table->string('name');

    $table->foreignId('teacher_id')
        ->nullable()
        ->constrained('teachers')
        ->nullOnDelete();

    $table->integer('capacity')->nullable();

    $table->boolean('is_active')->default(true);

    $table->timestamps();
    $table->softDeletes();

    $table->unique(['class_id', 'name']);
});

If the teachers table does not exist yet, remove teacher_id for now.

---

## Migration 7: students

Schema::create('students', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained('users')
        ->nullOnDelete();

    $table->foreignId('guardian_id')
        ->nullable()
        ->constrained('guardians')
        ->nullOnDelete();

    $table->string('admission_number')->unique();

    $table->string('first_name');
    $table->string('middle_name')->nullable();
    $table->string('last_name');

    $table->date('date_of_birth')->nullable();

    $table->enum('gender', ['male', 'female'])->nullable();

    $table->string('nationality')->nullable();
    $table->string('state')->nullable();
    $table->string('local_government')->nullable();
    $table->string('religion')->nullable();
    $table->string('tribe')->nullable();

    $table->text('address')->nullable();

    $table->date('admission_date')->nullable();

    $table->enum('status', [
        'active',
        'inactive',
        'graduated',
        'withdrawn',
        'suspended'
    ])->default('active');

    $table->timestamps();
    $table->softDeletes();
});

Rule:
Do not place section_id, class_id, or arm_id here if students can belong to many sections.

---

## Migration 8: student_section_enrollments

Schema::create('student_section_enrollments', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_id')
        ->constrained('students')
        ->cascadeOnDelete();

    $table->foreignId('section_id')
        ->constrained('sections')
        ->cascadeOnDelete();

    $table->foreignId('current_class_id')
        ->nullable()
        ->constrained('academic_classes')
        ->nullOnDelete();

    $table->foreignId('current_class_arm_id')
        ->nullable()
        ->constrained('class_arms')
        ->nullOnDelete();

    $table->date('enrolled_at')->nullable();

    $table->enum('status', [
        'active',
        'inactive',
        'graduated',
        'withdrawn',
        'suspended'
    ])->default('active');

    $table->timestamps();
    $table->softDeletes();

    $table->unique(['student_id', 'section_id']);
});

Meaning:
One student can have many enrollments, but only one active placement per section.

Example:
Student 1 -> Western Education
Student 1 -> Islamiyya

---

## Migration 9: subjects

Schema::create('subjects', function (Blueprint $table) {
    $table->id();

    $table->foreignId('section_id')
        ->constrained('sections')
        ->cascadeOnDelete();

    $table->string('name');
    $table->string('code')->nullable();

    $table->boolean('is_active')->default(true);

    $table->timestamps();
    $table->softDeletes();

    $table->unique(['section_id', 'name']);
});

Meaning:
Subjects are separated by section.

Example:
Western Education -> Mathematics
Islamiyya -> Qur'an
Islamiyya -> Arabic

---

## Migration 10: student_class_records

Schema::create('student_class_records', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_section_enrollment_id')
        ->constrained('student_section_enrollments')
        ->cascadeOnDelete();

    $table->foreignId('section_session_id')
        ->constrained('section_sessions')
        ->cascadeOnDelete();

    $table->foreignId('class_id')
        ->constrained('academic_classes')
        ->cascadeOnDelete();

    $table->foreignId('arm_id')
        ->nullable()
        ->constrained('class_arms')
        ->nullOnDelete();

    $table->decimal('overall_total', 8, 2)->default(0);
    $table->decimal('overall_average', 5, 2)->default(0);

    $table->unsignedInteger('overall_position')->nullable();
    $table->unsignedInteger('class_size')->nullable();

    $table->enum('promotion_status', [
        'pending',
        'promoted',
        'repeat',
        'graduated',
        'withdrawn'
    ])->default('pending');

    $table->timestamps();

    $table->unique(
        ['student_section_enrollment_id', 'section_session_id'],
        'unique_enrollment_section_session'
    );
});

Meaning:
This stores the student’s record for one section in one academic session.

Example:
Ahmad Musa -> Western Education -> 2025/2026 -> JSS 1

---

## Migration 11: student_term_records

Schema::create('student_term_records', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_class_record_id')
        ->constrained('student_class_records')
        ->cascadeOnDelete();

    $table->foreignId('term_id')
        ->constrained('terms')
        ->cascadeOnDelete();

    $table->decimal('total_marks', 8, 2)->default(0);
    $table->decimal('average_marks', 5, 2)->default(0);

    $table->unsignedInteger('position_in_class')->nullable();
    $table->unsignedInteger('class_size')->nullable();

    $table->string('overall_grade')->nullable();
    $table->string('remark')->nullable();

    $table->timestamps();

    $table->unique(['student_class_record_id', 'term_id']);
});

Meaning:
This stores the student’s term summary.

---

## Migration 12: results

Schema::create('results', function (Blueprint $table) {
    $table->id();

    $table->foreignId('student_term_record_id')
        ->constrained('student_term_records')
        ->cascadeOnDelete();

    $table->foreignId('subject_id')
        ->constrained('subjects')
        ->cascadeOnDelete();

    $table->decimal('ca', 5, 2)->default(0);
    $table->decimal('exam', 5, 2)->default(0);
    $table->decimal('total', 5, 2)->default(0);

    $table->string('grade')->nullable();
    $table->string('remark')->nullable();

    $table->timestamps();

    $table->unique(['student_term_record_id', 'subject_id']);
});

Rule:
Calculate total in Laravel:

total = ca + exam

This works better for both SQLite and MySQL.

---

## Default Section Seeder Algorithm

When the system is installed, create one default section called General.

Algorithm:

1. Check if section with slug general exists.
2. If it does not exist, create it.
3. Set is_default to true.
4. Set is_active to true.

Code idea:

Section::firstOrCreate(
    ['slug' => 'general'],
    [
        'name' => 'General',
        'description' => 'Default section for schools that do not use multiple sections.',
        'is_default' => true,
        'is_active' => true,
    ]
);

---

## Admission Approval Algorithm

When an application is approved:

1. Start database transaction.

2. Get or create guardian.

3. Create student personal record.

4. For each section selected in the application:

    a. Get section_id.

    b. Get selected class_id for that section.

    c. Choose best class arm:
       - Get all active arms under the selected class.
       - Count active students in each arm.
       - Pick the arm with the lowest number of active students.
       - If tie, pick the arm alphabetically.

    d. Create student_section_enrollment:
       - student_id
       - section_id
       - current_class_id
       - current_class_arm_id
       - enrolled_at
       - status = active

    e. Find ongoing section_session for that section.

    f. Create student_class_record:
       - student_section_enrollment_id
       - section_session_id
       - class_id
       - arm_id
       - promotion_status = pending

    g. Find ongoing term under that section_session.

    h. If ongoing term exists, create student_term_record:
       - student_class_record_id
       - term_id

5. Update application status to approved.

6. Commit transaction.

7. If anything fails, rollback transaction.

---

## Admission Approval Code Skeleton

DB::transaction(function () use ($application) {

    $guardian = getOrCreateGuardianFromApplication($application);

    $student = Student::create([
        'guardian_id' => $guardian->id,
        'admission_number' => AdmissionNumberGenerator::generate('student'),
        'first_name' => $application->student_first_name,
        'middle_name' => $application->student_middle_name,
        'last_name' => $application->student_last_name,
        'date_of_birth' => $application->student_date_of_birth,
        'gender' => $application->student_gender,
        'nationality' => $application->student_nationality,
        'state' => $application->student_state,
        'local_government' => $application->student_local_government,
        'religion' => $application->student_religion,
        'tribe' => $application->student_tribe,
        'address' => $application->student_address,
        'admission_date' => now(),
        'status' => 'active',
    ]);

    foreach ($application->selectedSections as $selectedSection) {

        $sectionId = $selectedSection->section_id;
        $classId = $selectedSection->class_id;

        $armId = chooseBestArm($classId);

        $enrollment = StudentSectionEnrollment::create([
            'student_id' => $student->id,
            'section_id' => $sectionId,
            'current_class_id' => $classId,
            'current_class_arm_id' => $armId,
            'enrolled_at' => now(),
            'status' => 'active',
        ]);

        $sectionSession = SectionSession::where('section_id', $sectionId)
            ->where('status', 'ongoing')
            ->firstOrFail();

        $classRecord = StudentClassRecord::firstOrCreate(
            [
                'student_section_enrollment_id' => $enrollment->id,
                'section_session_id' => $sectionSession->id,
            ],
            [
                'class_id' => $classId,
                'arm_id' => $armId,
                'promotion_status' => 'pending',
            ]
        );

        $ongoingTerm = Term::where('section_session_id', $sectionSession->id)
            ->where('status', 'ongoing')
            ->first();

        if ($ongoingTerm) {
            StudentTermRecord::firstOrCreate([
                'student_class_record_id' => $classRecord->id,
                'term_id' => $ongoingTerm->id,
            ]);
        }
    }

    $application->update([
        'status' => 'approved',
        'approved_at' => now(),
    ]);
});

---

## Best Arm Selection Algorithm

Function chooseBestArm(classId):

1. Get active arms for the class.
2. Count active student_section_enrollments in each arm.
3. Order by lowest active student count.
4. If count is equal, order by arm name.
5. Return the first arm id.
6. If no arm exists, return null.

Code idea:

function chooseBestArm(int $classId): ?int
{
    $arm = ClassArm::where('class_id', $classId)
        ->where('is_active', true)
        ->withCount([
            'students as active_students_count' => function ($query) {
                $query->where('status', 'active');
            }
        ])
        ->orderBy('active_students_count')
        ->orderBy('name')
        ->first();

    return $arm?->id;
}

ClassArm relationship needed:

public function students()
{
    return $this->hasMany(StudentSectionEnrollment::class, 'current_class_arm_id');
}

---

## Starting New Section Session Algorithm

When starting a new section session:

1. Select section.
2. Select session.
3. Check if the section already has an ongoing section_session.
4. If yes, prevent starting another one unless the old one is finished.
5. Create or update section_session as ongoing.
6. Create terms under that section_session.
7. If students are already enrolled in that section:
   - Create student_class_records for all active enrollments.
   - Use their current_class_id and current_class_arm_id.
8. Start first term if needed.

---

## Starting New Term Algorithm

When starting a new term for a section:

1. Select section_session.
2. Check if another term is already ongoing under that section_session.
3. If yes, prevent starting another term.
4. Set selected term to ongoing.
5. For every active student_class_record in that section_session:
   - Create student_term_record if missing.
6. Save.

---

## Result Upload Algorithm

When uploading result:

1. Select section.
2. Select class.
3. Select arm.
4. Select term.
5. Get student_term_records through:
   - term
   - student_class_record
   - student_section_enrollment
   - current class/arm
6. For each student:
   - Save result for each subject.
   - total = ca + exam
   - grade = calculateGrade(total)
   - remark = calculateRemark(total)
7. After saving all results:
   - Recalculate student_term_records total_marks.
   - Recalculate average_marks.
   - Recalculate position_in_class.
   - Recalculate class_size.
   - Recalculate overall_grade.

---

## Term Calculation Algorithm

For each student_term_record:

1. Sum all result totals.
2. Count subjects.
3. average_marks = total_marks / subject_count.
4. Save total_marks.
5. Save average_marks.
6. Save overall_grade.

Then calculate class position:

1. Get all student_term_records in the same:
   - term
   - class
   - arm if needed
2. Order by average_marks descending.
3. Assign positions.
4. If students have the same average, give them same position.
5. Save position_in_class and class_size.

---

## Promotion Algorithm

Promotion is done per section_session, not globally.

When a section session is finished:

1. Get all student_class_records in the section_session.
2. For each record:
   - Get student_section_enrollment.
   - Get current class.
   - Check overall_average.
3. If overall_average is greater than or equal to pass mark:
   - If current class has next_class_id:
      a. Move student_section_enrollment current_class_id to next_class_id.
      b. Choose best arm in next class.
      c. Update current_class_arm_id.
      d. Mark student_class_record promotion_status as promoted.
   - Else:
      a. Mark student_section_enrollment status as graduated.
      b. Mark student_class_record promotion_status as graduated.
4. If overall_average is below pass mark:
   - Keep student in current class.
   - Mark student_class_record promotion_status as repeat.
5. Mark section_session as finished.

---

## Promotion Code Skeleton

DB::transaction(function () use ($sectionSession) {

    $records = StudentClassRecord::with([
            'enrollment',
            'class.nextClass'
        ])
        ->where('section_session_id', $sectionSession->id)
        ->get();

    foreach ($records as $record) {

        $enrollment = $record->enrollment;
        $currentClass = $record->class;

        $passed = $record->overall_average >= 40;

        if ($passed) {
            $nextClass = $currentClass->nextClass;

            if ($nextClass) {
                $newArmId = chooseBestArm($nextClass->id);

                $enrollment->update([
                    'current_class_id' => $nextClass->id,
                    'current_class_arm_id' => $newArmId,
                    'status' => 'active',
                ]);

                $record->update([
                    'promotion_status' => 'promoted',
                ]);
            } else {
                $enrollment->update([
                    'status' => 'graduated',
                ]);

                $record->update([
                    'promotion_status' => 'graduated',
                ]);
            }
        } else {
            $record->update([
                'promotion_status' => 'repeat',
            ]);
        }
    }

    $sectionSession->update([
        'status' => 'finished',
    ]);
});

---

## Important Query Examples

Get all classes in a section:

AcademicClass::where('section_id', $sectionId)
    ->where('is_active', true)
    ->orderBy('sort_order')
    ->get();

Get ongoing session for a section:

SectionSession::where('section_id', $sectionId)
    ->where('status', 'ongoing')
    ->first();

Get ongoing term for a section:

Term::whereHas('sectionSession', function ($query) use ($sectionId) {
        $query->where('section_id', $sectionId)
              ->where('status', 'ongoing');
    })
    ->where('status', 'ongoing')
    ->first();

Get student active enrollments:

$student->sectionEnrollments()
    ->where('status', 'active')
    ->with(['section', 'currentClass', 'currentClassArm'])
    ->get();

Get students in a class arm:

StudentSectionEnrollment::where('current_class_id', $classId)
    ->where('current_class_arm_id', $armId)
    ->where('status', 'active')
    ->with('student')
    ->get();

---

## Rules To Follow In Controllers

1. Any page dealing with classes must ask for section first.

2. Any page dealing with terms must use section_session.

3. Any page dealing with promotion must promote section by section.

4. Any page dealing with results must filter by:
   - section
   - session
   - term
   - class
   - arm

5. Any page dealing with student placement must use student_section_enrollments.

6. Do not use students.class_id or students.arm_id if multi-section is supported.

7. If the school does not want multiple sections, use the General section only.

---

## Final Simple Rule

If the information can be different between Western Education and Islamiyya, connect it to section or section_session.

Examples:

Classes: section
Subjects: section
Sessions: section_session
Terms: section_session
Fees: section or class
Results: student_section_enrollment through records
Promotion: section_session
Student personal data: students table only
Guardian data: guardians table only

---

## Final Structure

sections
sessions
section_sessions
terms
academic_classes
class_arms
students
student_section_enrollments
subjects
student_class_records
student_term_records
results

This structure allows:

- One school section
- Many school sections
- Separate Islamic and Western calendars
- Separate classes per section
- One student in many sections
- Independent promotion per section
- Independent results per section