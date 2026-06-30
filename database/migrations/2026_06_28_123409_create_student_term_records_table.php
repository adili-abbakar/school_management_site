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
        Schema::create('student_term_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_session_record_id')->constrained()->cascadeOnDelete();

            $table->foreignId('term_id')->constrained('terms')->restrictOnDelete();

            $table->enum('status', [
                'active',
                'completed'
            ])->default('active');

            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->unique([
                'student_session_record_id',
                'term_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_term_records');
    }
};
