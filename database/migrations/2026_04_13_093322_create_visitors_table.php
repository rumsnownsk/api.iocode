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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->json('geolocation')->nullable();
            $table->text('city')->nullable();
            $table->text('provider')->nullable();
            $table->text('referrer')->nullable();
            $table->text('page_url');
            $table->string('page_title');
            $table->string('screen_resolution');
            $table->string('language', 10);
            $table->string('timezone')->nullable();
            $table->string('device_type', 20);
            $table->string('browser', 20);
            $table->string('os', 20);
            $table->string('session_id');
            $table->timestamp('visited_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
