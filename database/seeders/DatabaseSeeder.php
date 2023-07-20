<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $generate_password = Str::random(20);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@domain.tld',
            'password' => bcrypt($generate_password),
            'email_verified_at' => now(),
        ]);

        $mqtt_acl = \App\Models\MqttAcl::factory()->create([
            'user_id' => $user->id,
            'topic' => '#',
            'rw' => '4',
        ]);

        echo "-----------------IMPORTANT-----------------\n";
        echo 'Admin Username: '.$user->name."\n";
        echo 'Admin Email: '.$user->email."\n";
        echo 'login password: '.$generate_password."\n";
        echo 'mqtt password: '.$user->mqtt_token."\n";
        echo "-----------------IMPORTANT-----------------\n";
        echo "\n";

    }
}
