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
            $table->id('class_has_product_id');
            $table->bigInteger('class_id')->nullable()->unsigned();
            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->double('price', 10, 2)->nullable();
            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->bigInteger('updated_by')->nullable()->unsigned();
            $table->timestamps();
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
