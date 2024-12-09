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
        Schema::create('manuals', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable(true)->default(NULL);
            $table->string('revision_id')->nullable(true)->default(NULL);
            $table->string('ticket_no')->nullable(true)->default(NULL);
            $table->string('title')->nullable(true)->default(NULL);
            $table->longText('text')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manuals');
    }
};
