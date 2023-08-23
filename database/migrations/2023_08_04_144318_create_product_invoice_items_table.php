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
            $table->bigInteger('product_invoice_id')->nullable()->unsigned();
            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->double('product_invoice_item_price', 10, 2);
            $table->integer('product_invoice_item_quantity')->nullable()->unsigned();
            $table->double('product_invoice_item_subtotal', 10, 2);
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
        Schema::dropIfExists('product_invoice_items');
    }
};
