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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('first_name', 25);
            $table->string('middle_name', 25)->nullable();
            $table->string('last_name', 25);
            $table->string('contact_number', 15);
            $table->string('contact_number2', 15)->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city', 25);
            $table->string('state', 25);
            $table->integer('pin_code')->unsigned();
            $table->string('country', 25)->nullable();
            $table->integer('transport_id')->unsigned()->nullable();
            $table->string('aadhaar_number')->nullable();
            $table->string('blood_group');
            $table->string('mother_tongue')->nullable();
            $table->dateTime('date_of_birth');
            $table->string('place_of_birth')->nullable();
            $table->enum('gender', ['M', 'F', 'O']);
            $table->string('father_name', 50);
            $table->string('mother_name', 50);
            $table->string('remarks', 255)->nullable();
            $table->dateTime('termination_date')->nullable();
            $table->boolean('status');
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->string('email', 100)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_alternate', 100)->nullable()->unique();
            $table->string('password');
            $table->text('settings')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
};
