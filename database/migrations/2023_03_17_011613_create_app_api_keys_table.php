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
        Schema::create('app_api_keys', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('app_id');
            $table->string('api_key');
            $table->timestamp('last_rotated_at')->nullable();
            $table->boolean('is_paused')->default(false);
            $table->timestamps();
            $table->unique(['user_id', 'app_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_api_keys');
    }
};
