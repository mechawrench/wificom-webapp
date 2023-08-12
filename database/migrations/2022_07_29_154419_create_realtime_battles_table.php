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
        Schema::create('realtime_battles', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->integer('user_id');
            $table->string('initiator_com_uuid');
            $table->integer('opponent_id')->nullable();
            $table->string('opponent_com_uuid')->nullable();
            $table->string('invite_code');
            $table->string('device_type');
            $table->string('topic');
            $table->boolean('is_session_complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realtime_battles');
    }
};
