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
        Schema::create('quran_verses', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('surah');
            $table->unsignedSmallInteger('ayah');
            $table->text('arabic_text');
            $table->longText('translation_en')->nullable();
            $table->longText('translation_ur')->nullable();
            $table->longText('tafsir')->nullable();
            $table->timestamps();
            $table->unique(['surah','ayah']);
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quran_verses');
    }
};
