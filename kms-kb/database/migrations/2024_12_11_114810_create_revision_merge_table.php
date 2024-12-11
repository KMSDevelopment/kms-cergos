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
        Schema::create('revision_merge', function (Blueprint $table) {
            $table->id();
            $table->integer('revision_id')->nullable(true)->default(NULL);
            $table->integer('old_site_rev_id')->nullable(true)->default(NULL);
            $table->integer('odoo_rev_id')->nullable(true)->default(NULL);
            $table->integer('new_rev_id')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision_merge');
    }
};
