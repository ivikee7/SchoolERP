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
        Schema::create('class_has_products', function (Blueprint $table) {
            $table->uuid('class_has_product_id')->primary();
            $table->bigInteger('class_has_product_academic_session_id')->unsigned()->nullable();
            $table->integer('class_has_product_class_id')->unsigned()->nullable();
            $table->uuid('class_has_product_product_id')->nullable();
            $table->double('class_has_product_price', 10, 2)->nullable();
            $table->bigInteger('class_has_product_created_by')->nullable()->unsigned();
            $table->bigInteger('class_has_product_updated_by')->nullable()->unsigned();
            $table->timestamp('class_has_product_created_at')->nullable();
            $table->timestamp('class_has_product_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_has_products');
    }
};
