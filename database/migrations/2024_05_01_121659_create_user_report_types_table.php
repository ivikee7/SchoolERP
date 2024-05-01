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
        Schema::create('user_report_types', function (Blueprint $table) {
            $table->uuid('user_report_type_id');
            $table->string('user_report_type_name', 50);
            $table->boolean('user_report_type_status');
            $table->timestamp('user_report_type_created_at')->nullable();
            $table->timestamp('user_report_type_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_report_types');
    }
};
