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
        Schema::create('product_payments', function (Blueprint $table) {
            $table->uuid('product_payment_id')->primary();
            $table->uuid('product_payment_product_invoice_id')->nullable();
            $table->double('product_payment_total_due', 10, 2);
            $table->double('product_payment_payment_received', 10, 2);
            $table->double('product_payment_remaining_due', 10, 2);
            $table->bigInteger('product_payment_created_by')->unsigned()->nullable();
            $table->bigInteger('product_payment_updated_by')->unsigned()->nullable();
            $table->timestamp('product_payment_created_at')->nullable();
            $table->timestamp('product_payment_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_payments');
    }
};
