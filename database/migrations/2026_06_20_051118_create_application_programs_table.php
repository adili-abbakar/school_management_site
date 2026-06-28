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
        Schema::create('application_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_application_id')->constrained('student_applications')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('requested_class_id')->nullable()->constrained('classes');
            $table->foreignId('approved_class_id')->nullable()->constrained('classes');
            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'withdrawn'
            ])->default('pending');
            $table->timestamps();
            $table->text('remarks')->nullable();

            $table->unique(['student_application_id', 'program_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_programs');
    }
};
