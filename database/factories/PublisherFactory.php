<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'publisher_id' => $this->faker->uuid(),
        'publisher_name' => $this->faker->company(),
        'publisher_description' => $this->faker->sentences(),
    ];
}

}
