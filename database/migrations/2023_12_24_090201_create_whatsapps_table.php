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
        Schema::create('whatsapps', function (Blueprint $table) {
            $table->uuid('whatsapp_id')->primary();
            $table->string('whatsapp_title', 50)->nullable();
            $table->string('whatsapp_api_url', 100);
            $table->string('whatsapp_api_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapps');
    }
};
