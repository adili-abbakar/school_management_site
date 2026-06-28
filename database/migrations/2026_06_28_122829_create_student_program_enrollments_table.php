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

            // Student taking the program
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            // Program the student is enrolled in
            $table->foreignId('program_id')
                ->constrained()
                ->restrictOnDelete();

            // Original approved application (optional but recommended)
            $table->foreignId('application_program_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Date the student was admitted into this program
            $table->date('admission_date');

            // Current enrollment status
            $table->enum('status', [
                'active',
                'completed',
                'graduated',
                'withdrawn',
                'suspended'
            ])->default('active');

            // Administrative remarks
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Prevent duplicate enrollment in the same program
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
