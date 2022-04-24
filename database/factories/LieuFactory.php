<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LieuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->cityName(),
            'latitude' => rand(0, 100),
            'longitude' => rand(0, 100),
            'note' => rand(0, 5),
            'temps' => rand(0, 4),
            'difficulte' => $this->faker->randomElement(['famille' ,'amateur', 'sportif']),
            'note' => rand(0, 5),
        ];
    }
}
