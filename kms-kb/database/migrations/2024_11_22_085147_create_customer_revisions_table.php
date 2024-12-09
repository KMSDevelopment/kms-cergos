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
        Schema::create('customer_revisions', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->nullable(true)->default(NULL);
            $table->integer('revision_id');
            $table->integer('api_id')->nullable(true)->default(NULL);
            $table->string('odoo_id')->nullable(true)->default(NULL);
            $table->string('mgr_id')->nullable(true)->default(NULL);
            $table->string('brand_id')->nullable(true)->default(NULL);
            $table->string('customer_id')->nullable(true)->default(NULL);
            $table->string('user_id_assigned')->nullable(true)->default(NULL);
            $table->string('start')->nullable(true)->default(NULL);
            $table->string('end')->nullable(true)->default(NULL);
            $table->string('status')->nullable(true)->default(NULL);
            $table->double('sales_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_revisions');
    }
};
