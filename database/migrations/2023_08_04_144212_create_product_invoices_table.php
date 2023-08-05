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
        Schema::create('product_invoices', function (Blueprint $table) {
            $table->id('product_invoice_id');
            $table->bigInteger('buyer_id')->nullable()->unsigned();
            $table->double('total_price', 10, 2)->nullable();
            $table->double('discount', 10, 2)->nullable();
            $table->double('total_payable_amount', 10, 2)->nullable();
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
        Schema::dropIfExists('product_invoices');
    }
};
