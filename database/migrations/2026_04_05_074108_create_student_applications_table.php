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
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();

            // STUDENT DATA
            $table->string('student_first_name');
            $table->string('student_middle_name')->nullable();
            $table->string('student_last_name')->nullable();
            $table->date('student_date_of_birth');
            $table->enum('student_gender', ['male', 'female']);
            $table->string('student_nationality', 100);
            $table->string('student_state', 100);
            $table->string('student_local_government', 100);
            $table->string('student_religion');
            $table->string('student_tribe');
            $table->string('student_address');

            // GUARDIAN DATA
            $table->string('guardian_first_name')->nullable();
            $table->string('guardian_middle_name')->nullable();
            $table->string('guardian_last_name')->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->string('guardian_email')->nullable();
            $table->date('guardian_date_of_birth')->nullable();
            $table->enum('guardian_gender', ['male', 'female'])->nullable();
            $table->string('guardian_nationality', 100)->nullable();
            $table->string('guardian_state', 100)->nullable();
            $table->string('guardian_local_government', 100)->nullable();
            $table->string('guardian_religion')->nullable();
            $table->string('guardian_tribe')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->enum('guardian_relationship', [
                'father',
                'mother',
                'brother',
                'sister',
                'grandfather',
                'grandmother',
                'uncle',
                'aunt',
                'other'
            ])->default('father');

            // APPLICATION META
            $table->string('application_number')->unique();
            $table->string('previous_school_name')->nullable();
            $table->string('last_class_attended')->nullable();
            $table->enum('stream', ['arts', 'science'])->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->enum('status', [
                'pending',
                'processing',
                'approved',
                'awaiting_guardian_response',
                'rejected',
                'withdrawn',
            ])->default('pending');

            $table->unsignedBigInteger('submitted_by_user_id')->nullable();
            $table->foreign('submitted_by_user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->text('remarks')->nullable();
            $table->foreignId('decision_by')->nullable()->constrained('users');
            $table->date('decision_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_applications');
    }
};
