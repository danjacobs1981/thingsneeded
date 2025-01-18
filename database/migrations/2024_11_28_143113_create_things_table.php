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
        Schema::create('things', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('types')->cascadeOnUpdate()->noActionOnDelete();
            $table->boolean('purchasable')->nullable();
            $table->unsignedTinyInteger('position');
            $table->boolean('live')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::create('thing_translations', function (Blueprint $table) {
            $table->foreignId('thing_id')->constrained('things')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('lang_id')->constrained('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->text('subtext');
            $table->string('search_phrase')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('things');
    }
};
