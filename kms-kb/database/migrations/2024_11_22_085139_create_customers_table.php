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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('odoo_id')->nullable(true)->default(NULL);
            $table->integer('api_id')->nullable(true)->default(NULL);
            $table->string('mgr_id')->nullable(true)->default(NULL);
            $table->integer('comp_id')->nullable(true)->default(NULL);
            $table->integer('brand_id')->nullable(true)->default(NULL);
            $table->integer('model_id')->nullable(true)->default(NULL);
            $table->string('reference')->nullable(true)->default(NULL);
            $table->string('firstname')->nullable(true)->default(NULL);
            $table->string('middlename')->nullable(true)->default(NULL);
            $table->string('lastname')->nullable(true)->default(NULL);

            $table->string('gender')->nullable(true)->default(NULL);
            $table->string('birthdate')->nullable(true)->default(NULL);

            $table->string('email')->nullable(true)->default(NULL);
            $table->string('phonenr')->nullable(true)->default(NULL);
            $table->string('address')->nullable(true)->default(NULL);
            $table->string('housenr')->nullable(true)->default(NULL);
            $table->string('zipcode')->nullable(true)->default(NULL);
            $table->string('city')->nullable(true)->default(NULL);
            $table->string('country')->nullable(true)->default(NULL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
