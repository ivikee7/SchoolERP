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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('product_id')->primary();
            $table->string('product_name', 100);
            $table->string('product_description', 150)->nullable();
            $table->uuid('product_product_category_id')->nullable();
            $table->bigInteger('product_created_by')->nullable()->unsigned();
            $table->bigInteger('product_updated_by')->nullable()->unsigned();
            $table->timestamp('product_created_at')->nullable();
            $table->timestamp('product_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
