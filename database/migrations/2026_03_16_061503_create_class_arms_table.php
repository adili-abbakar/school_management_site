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
        Schema::create('class_arms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('teachers', 'user_id')
                ->nullOnDelete();

            $table->string('name', 50);

            $table->unsignedInteger('capacity')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['class_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_arms');
    }
};
