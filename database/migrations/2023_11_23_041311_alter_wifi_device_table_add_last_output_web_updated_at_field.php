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
        Schema::table('wifi_devices', function (Blueprint $table) {
            // Change the name field to be unique
            $table->timestamp('last_output_web_updated_at')
                ->after('last_output_web')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('wifi_devices', function (Blueprint $table) {
            $table->dropColumn('last_output_web_updated_at');
        });
    }
};
