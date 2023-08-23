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
        Schema::create('books', function (Blueprint $table) {
            $table->id('id');
            $table->string('book_title', 100);
            $table->string('book_edition')->nullable();
            $table->year('book_published_at')->nullable();
            $table->string('book_note')->nullable();
            $table->double('book_price', 8, 2)->nullable();
            $table->double('book_pages', 8, 2)->nullable();
            $table->string('book_isbn', 100)->nullable();
            $table->string('book_author', 100)->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->bigInteger('publisher_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('location_id')->unsigned()->nullable();
            $table->bigInteger('language_id')->unsigned()->nullable();
            $table->integer('class_id')->unsigned()->nullable();
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->date('purchased_at')->nullable();
            $table->bigInteger('accession_number')->nullable(); // Tempreary
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('book_authors');
            $table->foreign('publisher_id')->references('id')->on('book_publishers');
            $table->foreign('category_id')->references('id')->on('book_categories');
            $table->foreign('location_id')->references('id')->on('book_locations');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('class_id')->references('id')->on('student_classes');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('supplier_id')->references('id')->on('book_suppliers');
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
        Schema::dropIfExists('books');
    }
};
