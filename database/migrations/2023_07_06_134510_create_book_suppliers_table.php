<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name', 100);
            $table->string('supplier_address', 255)->nullable();
            $table->string('supplier_contact', 10)->nullable();
            $table->string('supplier_contact2', 10)->nullable();
            $table->string('supplier_email', 100)->nullable();
            $table->boolean('supplier_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_suppliers');
    }
};
