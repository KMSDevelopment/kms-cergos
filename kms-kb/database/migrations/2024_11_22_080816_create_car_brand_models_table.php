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
        Schema::create('car_brand_models', function (Blueprint $table) {
            $table->id();
            $table->string('api_id')->nullable(true)->default(NULL);
            $table->integer('brand_id');
            $table->string('model');
            $table->string('img')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_brand_models');
    }
};
