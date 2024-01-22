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
        Schema::create('product_invoice_items', function (Blueprint $table) {
            $table->id('product_invoice_item_id');
            $table->bigInteger('product_invoice_item_product_invoice_id')->nullable()->unsigned();
            $table->bigInteger('product_invoice_item_class_has_product_id')->nullable()->unsigned();
            $table->double('product_invoice_item_price', 10, 2);
            $table->integer('product_invoice_item_quantity')->nullable()->unsigned();
            $table->bigInteger('product_invoice_item_created_by')->nullable()->unsigned();
            $table->bigInteger('product_invoice_item_updated_by')->nullable()->unsigned();
            $table->timestamp('product_invoice_item_created_at')->nullable();
            $table->timestamp('product_invoice_item_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_invoice_items');
    }
};
