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
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id');
            $table->longText('ref')->nullable(true);
            $table->longText('title');
            $table->longText('complain_desc');
            $table->integer('problem_type_id')->default(0);
            $table->longText('revision_desc')->nullable(true);
            $table->longText('price_ex')->nullable(true);
            $table->longText('price_inc')->nullable(true);
            $table->longText('parts')->nullable(true);
            $table->longText('models')->nullable(true);
            $table->integer('checked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
