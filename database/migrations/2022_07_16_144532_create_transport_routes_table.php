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
        Schema::create('transport_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name', 25);
            $table->string('discreaption');
            $table->bigInteger('vehicle_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned()->nullable();
            $table->bigInteger('driver_id')->unsigned();
            $table->bigInteger('helper_id')->unsigned()->nullable();
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('vehicle_id')->references('id')->on('transport_vehicles');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->foreign('helper_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transport_routes');
    }
};
