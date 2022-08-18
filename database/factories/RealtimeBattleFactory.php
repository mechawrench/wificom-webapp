<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RealtimeBattle>
 */
class RealtimeBattleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => hexdec(uniqid()),
            'user_id' => null,
            'initiator_com_uuid' => hexdec(uniqid()),
            'opponent_id' => null,
            'opponent_com_uuid' => hexdec(uniqid()),
            'invite_code' => null,
            'device_type' => array_rand(['legendz', 'digimon-penz', 'digimon-penx']),
            'topic' => $this->faker->word,
            'is_session_complete' => false,
            'last_activity_at' => now(),
        ];
    }
}
