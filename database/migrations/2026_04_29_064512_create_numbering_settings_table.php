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
        Schema::create('numbering_settings', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();

            $table->string('prefix')->nullable();
            $table->string('separator')->default('/')->nullable();
            $table->boolean('include_year')->default(true);

            $table->unsignedInteger('padding')->default(3);
            $table->unsignedBigInteger('next_number')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('numbering_settings');
    }
};
