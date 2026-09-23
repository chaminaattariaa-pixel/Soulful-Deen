<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPageAndJuzToAyahsTable extends Migration
{
    public function up()
    {
        Schema::table('ayahs', function (Blueprint $table) {
            $table->integer('page')->nullable()->after('english_text');
            $table->integer('juz')->nullable()->after('page');
        });
    }

    public function down()
    {
        Schema::table('ayahs', function (Blueprint $table) {
            $table->dropColumn(['page', 'juz']);
        });
    }
}