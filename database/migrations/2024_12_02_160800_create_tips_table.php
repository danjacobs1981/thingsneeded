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
        Schema::create('tips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedTinyInteger('position');
            $table->boolean('live')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::create('tip_translations', function (Blueprint $table) {
            $table->foreignId('tip_id')->constrained('tips')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('lang_id')->constrained('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->text('subtext');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
        });
        Schema::dropIfExists('tips');
        Schema::dropIfExists('tip_translations');
    }
};
