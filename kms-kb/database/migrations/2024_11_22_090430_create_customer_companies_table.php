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
        Schema::create('customer_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('vat')->nullable(true)->default(NULL);
            $table->string('company_name')->nullable(true)->default(NULL);
            $table->string('logo')->nullable(true)->default(NULL);
            $table->string('email')->nullable(true)->default(NULL);
            $table->string('invoice_email')->nullable(true)->default(NULL);
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
        Schema::dropIfExists('customer_companies');
    }
};
