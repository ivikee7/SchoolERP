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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('joining_date');
            $table->dateTime('termination_date')->nullable();
            $table->integer('allocated_casual_leave')->nullable();
            $table->integer('allocated_sick_leave')->nullable();
            $table->string('pf_number')->nullable();
            $table->string('esi_number')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('un_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('travel_allowance')->nullable();
            $table->string('gross_salary')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('grade_salary')->nullable();
            $table->string('salary_review_date')->nullable();
            $table->string('pf')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_information');
    }
};
