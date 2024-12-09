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
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(true);
            $table->string('desc');
            $table->string('platform');
            $table->string('docs');
            $table->string('endpoint');
            $table->string('api_route')->nullable(true)->default(NULL);
            $table->string('api_point_route')->nullable(true)->default(NULL);
            $table->string('credentials');
            $table->integer('active')->default(0);
            $table->integer('sort')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_calls');
    }
};
