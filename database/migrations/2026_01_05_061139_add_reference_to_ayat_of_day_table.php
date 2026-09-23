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
        Schema::table('ayat_of_day', function (Blueprint $table) {
        
            $table->string('reference')->nullable()->after('english');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ayat_of_day', function (Blueprint $table) {
            
            $table->dropColumn('reference');
        });
    }
};
