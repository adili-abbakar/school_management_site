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
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('admission_number', 50)->unique();

            $table->foreignId('current_class_arm_id')
                ->nullable()
                ->constrained('class_arms')
                ->nullOnDelete();

            $table->enum('current_status', ['active', 'graduated', 'withdrawn', 'suspended'])
                ->default('active');

            $table->date('admission_date');
            $table->date('graduation_date')->nullable();

            $table->unsignedBigInteger('guardian_user_id')->nullable();


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

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('guardian_user_id')
                ->references('user_id')
                ->on('guardians')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
