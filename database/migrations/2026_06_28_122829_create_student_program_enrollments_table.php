<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_program_enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained('students', 'user_id')->cascadeOnDelete();

            $table->foreignId('program_id')->constrained('programs')->restrictOnDelete();
            
            $table->foreignId('application_program_id')->nullable()->constrained('application_programs')->nullOnDelete();

            $table->date('admission_date');

            $table->enum('status', [
                'active',
                'completed',
                'graduated',
                'withdrawn',
                'suspended'
            ])->default('active');

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->unique([
                'student_id',
                'program_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_program_enrollments');
    }
};
