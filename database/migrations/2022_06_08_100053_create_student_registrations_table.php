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
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('title', 5);
            $table->string('first_name', 25);
            $table->string('middle_name', 25)->nullable();
            $table->string('last_name', 25);
            $table->dateTime('date_of_birth')->nullable();
            $table->enum('gender', ['M', 'F', 'O']);
            $table->string('father_name', 50)->nullable();
            $table->string('father_qualification', 50)->nullable();
            $table->string('father_occupation', 50)->nullable();
            $table->string('father_contact_number', 15)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('mother_qualification', 50)->nullable();
            $table->string('mother_occupation', 50)->nullable();
            $table->string('mother_contact_number', 15)->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('city', 25)->nullable();
            $table->string('state', 25)->nullable();
            $table->integer('pin_code')->nullable();
            $table->integer('registration_class_id')->unsigned();
            $table->string('last_attended_school')->nullable();
            $table->integer('last_attended_class_id')->unsigned()->nullable();
            $table->string('payment_mode', 15);
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('registration_class_id')->references('id')->on('student_classes');
            $table->foreign('last_attended_class_id')->references('id')->on('student_classes');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_registrations');
    }
};
