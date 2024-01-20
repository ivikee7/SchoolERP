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
            $table->uuid('product_invoice_id')->primary();
            $table->bigInteger('product_invoice_buyer_id')->nullable()->unsigned();
            $table->double('product_invoice_subtotal', 10, 2)->nullable();
            $table->double('product_invoice_discount', 10, 2)->nullable();
            $table->double('product_invoice_gross_total', 10, 2)->nullable();
            $table->double('product_invoice_due', 10, 2)->nullable();
            $table->datetime('product_invoice_due_date')->nullable();
            $table->bigInteger('product_invoice_created_by')->nullable()->unsigned();
            $table->bigInteger('product_invoice_updated_by')->nullable()->unsigned();
            $table->timestamp('product_invoice_created_at')->nullable();
            $table->timestamp('product_invoice_updated_at')->nullable();
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
