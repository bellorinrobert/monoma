<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->firstName(),
            'source' => fake()->lastName(),
            'owner' => fake()->numberBetween(1,2),
            'created_by' => fake()->numberBetween(1,2),
        ];
    }
}
