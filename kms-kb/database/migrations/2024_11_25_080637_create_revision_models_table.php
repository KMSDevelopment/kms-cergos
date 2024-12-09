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
        Schema::create('revision_models', function (Blueprint $table) {
            $table->id();
            $table->integer('revision_id');
            $table->string('brand_id')->nullable(true)->default(NULL);
            $table->string('model_id')->nullable(true)->default(NULL);
            $table->string('type_id')->nullable(true)->default(NULL);
            $table->string('variant_id')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revision_models');
    }
};
