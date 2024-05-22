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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->bigInteger('price');
            $table->bigInteger('sale_price');
            $table->bigInteger('discount_price')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->dateTime('discount_date')->nullable();
            $table->integer('count');
            $table->string('color');
            $table->boolean('active_discount')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
