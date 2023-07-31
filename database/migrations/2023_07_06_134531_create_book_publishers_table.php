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
        Schema::create('book_publishers', function (Blueprint $table) {
            $table->id();
            $table->string('publisher_name', 100);
            $table->string('publisher_email', 50)->nullable();
            $table->string('publisher_contact', 10)->nullable();
            $table->string('publisher_contact2', 10)->nullable();
            $table->string('publisher_location', 100)->nullable();
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
        Schema::dropIfExists('book_publishers');
    }
};
