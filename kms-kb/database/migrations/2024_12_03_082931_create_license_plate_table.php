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
        Schema::create('license_plate', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->nullable(true)->default(NULL);
            $table->string('license_plate')->nullable(true)->default(NULL);
            $table->string('brand_id')->nullable(true)->default(NULL);
            $table->string('brand_model_id')->nullable(true)->default(NULL);
            $table->string('revision_id')->nullable(true)->default(NULL);
            $table->string('revision_model_id')->nullable(true)->default(NULL);
            $table->string('customer_id')->nullable(true)->default(NULL);

            $table->string('eerste_tenaamstelling')->nullable(true)->default(NULL);
            $table->string('datum_tenaamstelling')->nullable(true)->default(NULL);
            $table->string('vervaldatum_apk')->nullable(true)->default(NULL);
            $table->string('catalogusprijs')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('license_plate');
    }
};
