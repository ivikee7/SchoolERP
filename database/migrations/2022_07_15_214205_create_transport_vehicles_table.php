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
        Schema::create('transport_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number', 50);
            $table->bigInteger('transport_type_id')->unsigned();
            $table->dateTime('purchase_date')->nullable();
            $table->dateTime('sale_date')->nullable();
            $table->dateTime('registration_date')->nullable();
            $table->dateTime('insurance_date')->nullable();
            $table->dateTime('fitness_date')->nullable();
            $table->dateTime('permit_date')->nullable();
            $table->timestamps();
            $table->foreign('transport_type_id')->references('id')->on('transport_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_vehicles');
    }
};
