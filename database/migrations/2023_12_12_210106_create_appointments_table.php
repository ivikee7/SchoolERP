<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('appointment_id')->primary();
            $table->string('appointment_name', 50)->nullable();
            $table->string('appointment_clint_name', 50)->nullable();
            $table->boolean('appointment_status')->nullable();
            $table->string('appointment_remark', 200)->nullable();
            $table->timestamp('appointment_start')->nullable();
            $table->timestamp('appointment_end')->nullable();
            $table->bigInteger('appointment_created_by')->unsigned()->nullable();
            $table->bigInteger('appointment_updated_by')->unsigned()->nullable();
            $table->timestamp('appointment_created_at')->nullable();
            $table->timestamp('appointment_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
