<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
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
            'name' => $this->faker->name(),
            'slug' => \Str::slug($this->faker->name()),
            'description' => $this->faker->sentence(),
            'logo' => $this->faker->imageUrl(),
            'website' => $this->faker->url(),
            'is_active' => true,
            'is_public' => rand(0, 1),
            'is_third_party_enabled' => rand(0, 1),
            'is_output_hidden' => rand(0, 1),
        ];
    }
}
