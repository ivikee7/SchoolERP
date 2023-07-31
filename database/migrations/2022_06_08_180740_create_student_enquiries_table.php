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
        Schema::create('student_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('first_name', 25);
            $table->string('middle_name', 25)->nullable();
            $table->string('last_name', 25);
            $table->enum('gender', ['M', 'F', 'O']);
            $table->dateTime('date_of_birth')->nullable();
            $table->integer('enquiry_class_id')->unsigned();
            $table->string('father_name', 50)->nullable();
            $table->string('mother_name', 50)->nullable();
            $table->string('contact_number', 15);
            $table->string('contact_number2', 15)->nullable();
            $table->string('address_line1')->nullable();
            $table->string('city', 25)->nullable();
            $table->string('state', 25)->nullable();
            $table->integer('pin_code')->unsigned()->nullable();
            $table->string('country', 25)->nullable();
            $table->string('last_attended_school', 50)->nullable();
            $table->integer('last_attended_class')->unsigned()->nullable();
            $table->string('source', 25)->nullable();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('enquiry_class_id')->references('id')->on('student_classes');
            $table->foreign('last_attended_class')->nullable()->references('id')->on('student_classes');
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
        Schema::dropIfExists('student_enquiries');
    }
};
