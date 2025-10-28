<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shelf>
 */
class ShelfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'shelf_id' => $this->faker->uuid(),
        'shelf_name' => 'Rak ' . $this->faker->randomLetter(),
        'shelf_position' => 'Lantai ' . $this->faker->numberBetween(1, 5),
    ];
}

}
