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
        Schema::create('student_session_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_program_enrollment_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('session_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('class_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('class_arm_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('status', [
                'active',
                'completed',
                'promoted',
                'repeated',
                'graduated',
                'withdrawn'
            ])->default('active');

            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();

            $table->timestamps();

            $table->unique([
                'student_program_enrollment_id',
                'session_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_session_records');
    }
};
