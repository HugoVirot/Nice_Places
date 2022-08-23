<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'nom' => 'Auvergne-Rhône-Alpes',
        ]);

        Region::create([
            'nom' => 'Bourgogne-Franche-Comté',
        ]);

        Region::create([
            'nom' => 'Bretagne',
        ]);

        Region::create([
            'nom' => 'Centre-Val de Loire',
        ]);

        Region::create([
            'nom' => 'Corse',
        ]);

        Region::create([
            'nom' => 'Grand Est',
        ]);

        Region::create([
            'nom' => 'Hauts-de-France',
        ]);

        Region::create([
            'nom' => 'Ile-de-France',
        ]);

        Region::create([
            'nom' => 'Normandie',
        ]);

        Region::create([
            'nom' => 'Nouvelle-Aquitaine',
        ]);

        Region::create([
            'nom' => 'Occitanie',
        ]);

        Region::create([
            'nom' => 'Pays de la Loire',
        ]);

        Region::create([
            'nom' => 'Provence-Alpes-Côte d’Azur',
        ]);

        Region::create([
            'nom' => 'Départements d\'Outre-Mer',
        ]);
    }
}
