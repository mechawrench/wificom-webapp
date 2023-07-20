<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WifiDevice>
 */
class WifiDeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => null,
            'pending_digirom' => 'v1-1111',
            'device_name' => $this->faker->name(),
            'device_comments' => $this->faker->sentence(),
            'local_ip_address' => null,
            'remote_ip_address' => null,
            'last_output' => 's:0000 r: 1111',
            'last_valid_output' => 's:0000 r: 1111',
            'last_ping_at' => now(),
            'last_used_at' => now(),
            'last_code_sent_at' => now(),
        ];
    }
}
