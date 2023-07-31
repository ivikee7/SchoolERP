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
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();
            $table->integer('student_class_id')->unsigned();
            $table->integer('student_section_id')->unsigned();
            $table->bigInteger('student_admission_id')->unsigned();
            $table->boolean('status')->nullable();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('updated_by_id')->unsigned();
            $table->timestamps();
            $table->foreign('student_class_id')->references('id')->on('student_classes');
            $table->foreign('student_section_id')->references('id')->on('student_sections');
            $table->foreign('student_admission_id')->references('id')->on('student_admissions');
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_promotions');
    }
};
