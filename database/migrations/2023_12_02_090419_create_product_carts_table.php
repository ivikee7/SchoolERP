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
        Schema::create('product_carts', function (Blueprint $table) {
            $table->uuid('product_cart_id')->primary();
            $table->bigInteger('product_cart_buyer_id')->unsigned()->nullable();
            $table->uuid('product_cart_product_id')->nullable();
            $table->integer('product_cart_quantity')->nullable();
            $table->timestamp('product_cart_created_at')->nullable();
            $table->timestamp('product_cart_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_carts');
    }
};
