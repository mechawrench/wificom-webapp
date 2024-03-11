Here is the rewritten code selection:

```
// Start of Selection
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('wifi_devices', function (Blueprint $table) {
            $table->string('pending_digirom', 700)->change();
        });
    }

    public function down()
    {
        Schema::table('wifi_devices', function (Blueprint $table) {
            $table->string('pending_digirom', 255)->change();
        });
    }
};
