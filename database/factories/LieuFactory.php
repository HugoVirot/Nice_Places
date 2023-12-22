<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lieu;

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
        static $number = 1;

        return [
            'nom' => 'Lieu de test n°' . $number++,
            'description' => $this->faker->sentence(),
            'latitude' => rand(44, 49),
            'longitude' => rand(-1, 6.9),
            'note' => rand(6, 10),
            'temps' => rand(1, 5),
            'difficulte' => $this->faker->randomElement(['famille' ,'amateur', 'sportif']),
            'adresse' => '15, route du test',
            'code_postal' => substr($this->faker->departmentNumber() . '000', 0, 5),
            'ville' => $this->faker->randomElement(['Ville de Test' ,'TestVille', 'Ville Fictive']),
            'user_id' => rand(2, 10),
            'categorie_id' => rand(1,9),
            'departement_id' => rand(1,99)
        ];
    }
}
