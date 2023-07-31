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
        Schema::create('book_borrows', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('borrow_book_id')->unsigned()->nullable();
            $table->bigInteger('borrow_user_id')->unsigned()->nullable();
            $table->bigInteger('borrow_issued_by')->unsigned()->nullable();
            $table->dateTime('borrow_issued_at')->nullable();
            $table->bigInteger('borrow_received_by')->unsigned()->nullable();
            $table->dateTime('borrow_received_at')->nullable();
            $table->date('borrow_due_date')->nullable();
            $table->date('borrow_lost_at')->nullable();
            $table->bigInteger('borrow_lost_updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('borrow_book_id')->references('id')->on('books');
            $table->foreign('borrow_user_id')->references('id')->on('users');
            $table->foreign('borrow_issued_by')->references('id')->on('users');
            $table->foreign('borrow_received_by')->references('id')->on('users');
            $table->foreign('borrow_lost_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_borrows');
    }
};
