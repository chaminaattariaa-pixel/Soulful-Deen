<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToSurahsTable extends Migration
{
    public function up()
    {
        Schema::table('surahs', function (Blueprint $table) {
            $table->string('name')->after('surah_number');
            $table->string('english_name')->nullable()->after('name');
            $table->integer('number_of_ayahs')->nullable()->after('english_name');
            $table->string('revelation_type')->nullable()->after('number_of_ayahs');
        });
    }

    public function down()
    {
        Schema::table('surahs', function (Blueprint $table) {
            $table->dropColumn(['name', 'english_name', 'number_of_ayahs', 'revelation_type']);
        });
    }
}