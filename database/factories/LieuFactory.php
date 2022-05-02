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
            'nom' => Str::random(),
            'description' => $this->faker->sentence(),
            'latitude' => rand(0, 100),
            'longitude' => rand(0, 100),
            'note' => rand(6, 10),
            'temps' => rand(0, 5),
            'difficulte' => $this->faker->randomElement(['famille' ,'amateur', 'sportif']),
            'adresse' => $this->faker->secondaryAddress(),
            'code_postal' => substr($this->faker->departmentNumber() . '000', 0, 5),
            'ville' => $this->faker->randomElement(['Lyon' ,'Marseille', 'Nantes', 'Niort', 'Fontenay-le-Comte', 'Bordeaux', 'Annecy']),
            'user_id' => rand(2, 10)
        ];
    }
}
