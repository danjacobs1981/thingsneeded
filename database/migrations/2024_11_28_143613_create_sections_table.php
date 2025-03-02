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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('position');
            $table->boolean('live')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::create('section_translations', function (Blueprint $table) {
            $table->foreignId('section_id')->constrained('sections')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('lang_id')->constrained('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
