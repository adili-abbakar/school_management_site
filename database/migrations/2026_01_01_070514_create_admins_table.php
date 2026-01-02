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
        Schema::create('admins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('staff_number', 50)->unique();
            $table->enum('role_type', ['SUPER_ADMIN', 'EXAM_OFFICER', 'ADMISSION_OFFICER']);
            $table->string('highest_qualification')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->date('start_date')->nullable();
            $table->enum('employment_type', ['Fulltime', 'Parttime', 'Contract'])->default('Fulltime');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
