<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();

            $table->string('specialized_subject', 255)->nullable();

            $table->string('highest_qualification')->nullable();
            $table->integer('years_of_experience')->default(0);
            $table->date('start_date')->nullable();
            $table->enum('employment_type', ['full_time', 'part_time', 'contract'])->default('full_time');

            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('staff_id')
            ->constrained('staff')
            ->cascadeOnDelete();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
