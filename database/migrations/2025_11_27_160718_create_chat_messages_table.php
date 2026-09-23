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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('role',['user','assistant','system'])->default('user');
            $table->longText('message');
            $table->json('source_reference')->nullable();
            $table->string('lang',2)->default('en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
