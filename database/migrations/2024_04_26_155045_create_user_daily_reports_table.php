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
        Schema::create('user_daily_reports', function (Blueprint $table) {
            $table->uuid('user_daily_report_id');
            $table->uuid('user_daily_report_user_report_type_id');
            $table->bigInteger('user_daily_report_user_id')->nullable()->unsigned();
            $table->string('user_daily_report_job_description')->nullable();
            $table->timestamp('user_daily_report_start_time')->nullable();
            $table->timestamp('user_daily_report_end_time')->nullable();
            $table->string('user_daily_report_total_time')->nullable();
            $table->bigInteger('user_daily_report_created_by')->nullable()->unsigned();
            $table->bigInteger('user_daily_report_updated_by')->nullable()->unsigned();
            $table->timestamp('user_daily_report_created_at')->nullable();
            $table->timestamp('user_daily_report_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_daily_reports');
    }
};
