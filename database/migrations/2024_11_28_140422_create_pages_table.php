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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('input_topic');
            $table->string('input_prompt');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->noActionOnDelete();
            $table->string('image')->nullable();
            $table->boolean('translated')->nullable();
            $table->boolean('related')->nullable();
            $table->boolean('live')->nullable();
            $table->timestamps();
        });

        Schema::create('page_translations', function (Blueprint $table) {
            $table->foreignId('page_id')->constrained('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('lang_id')->constrained('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->text('introduction');
            $table->text('conclusion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('pages');
    }
};
