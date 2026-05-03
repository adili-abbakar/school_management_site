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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            $table->foreignId('class_level_id')
                ->nullable()
                ->constrained('class_levels')
                ->nullOnDelete();

            $table->string('name')->index();

            $table->foreignId('next_class_id')
                ->nullable()
                ->unique()
                ->constrained('classes')
                ->nullOnDelete();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['section_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
