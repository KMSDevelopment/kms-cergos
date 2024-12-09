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
        Schema::create('car_model_types_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->string('model_id')->nullable(true)->default(NULL);
            $table->string('type_id')->nullable(true)->default(NULL);
            $table->string('variant')->nullable(true)->default(NULL);
            $table->string('build')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_model_types_variants');
    }
};
