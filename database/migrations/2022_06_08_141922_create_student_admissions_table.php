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
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('registration_id')->unsigned()->nullable();
            $table->bigInteger('academic_session_id')->unsigned();
            $table->integer('student_quota_id')->unsigned();
            $table->integer('admission_class_id')->unsigned();
            $table->integer('admission_section_id')->unsigned();
            $table->integer('current_class_id')->unsigned();
            $table->integer('current_section_id')->unsigned();
            $table->bigInteger('local_guardian_profile_id')->nullable()->unsigned();
            $table->string('relationship')->nullable();
            $table->boolean('admission_status')->nullable();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('updated_by_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('registration_id')->references('id')->on('student_registrations');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->foreign('student_quota_id')->references('id')->on('student_quotas');
            $table->foreign('admission_class_id')->references('id')->on('student_classes');
            $table->foreign('admission_section_id')->references('id')->on('student_sections');
            $table->foreign('current_class_id')->references('id')->on('student_classes');
            $table->foreign('current_section_id')->references('id')->on('student_sections');
            $table->foreign('local_guardian_profile_id')->references('id')->on('users');
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
        Schema::dropIfExists('student_admissions');
    }
};
