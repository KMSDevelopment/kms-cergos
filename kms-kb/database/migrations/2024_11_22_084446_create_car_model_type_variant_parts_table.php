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
        Schema::create('car_model_type_variant_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable(true)->default(NULL);
            $table->string('model_id')->nullable(true)->default(NULL);
            $table->string('model_type_id')->nullable(true)->default(NULL);
            $table->string('variant_id')->nullable(true)->default(NULL);
            $table->string('distributor_id')->nullable(true)->default(NULL);
            $table->string('distributor_product_nr')->nullable(true)->default(NULL);

            $table->string('mgr')->default(0);
            $table->string('ref')->nullable(true)->default(NULL);
            $table->string('code');
            
            $table->string('name');
            $table->string('img')->nullable(true);

            $table->double('sales_price')->default(0);
            $table->double('sales_price_inc_vat')->default(0);
            $table->double('purchase_price')->default(0);
            $table->double('purchase_price_inc_vat')->default(0);
            $table->double('vat')->default(0);

            $table->integer('stock')->default(0);
            $table->string('stock_location')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_model_type_variant_parts');
    }
};
