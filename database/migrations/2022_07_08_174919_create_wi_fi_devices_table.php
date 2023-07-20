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
    public function up(): void
    {
        Schema::create('wifi_devices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->integer('user_id');
            $table->string('pending_digirom')
                ->before('last_update_at')
                ->nullable();
            $table->string('device_name')->nullable();
            $table->text('device_comments')->nullable();
            $table->string('local_ip_address')->nullable();
            $table->string('remote_ip_address')->nullable();
            $table->string('last_output')->nullable();
            $table->string('last_valid_output')->nullable();
            $table->timestamp('last_ping_at')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('last_code_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('wi_fi_devices');
    }
};
