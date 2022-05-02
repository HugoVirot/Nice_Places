<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorieLieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // forêt de Mervent => forêts
        DB::table('categories_lieux')->insert([
            'categorie_id' => 2,
            'lieu_id' => 1
        ]);

        // parc Ornithologique => zoos
        DB::table('categories_lieux')->insert([
            'categorie_id' => 8,
            'lieu_id' => 2
        ]);

        // Jardin des Plantes => parcs urbains
        DB::table('categories_lieux')->insert([
            'categorie_id' => 6,
            'lieu_id' => 3
        ]);

        // Zoo de la Palmyre  => zoos
        DB::table('categories_lieux')->insert([
            'categorie_id' => 8,
            'lieu_id' => 4
        ]);

        // Planète Sauvage  => zoos
        DB::table('categories_lieux')->insert([
            'categorie_id' => 8,
            'lieu_id' => 5
        ]);

        // Marais Poitevin => forêts et bois
        DB::table('categories_lieux')->insert([
            'categorie_id' => 2,
            'lieu_id' => 6
        ]);

        // Marais Poitevin => fleuves
        DB::table('categories_lieux')->insert([
            'categorie_id' => 4,
            'lieu_id' => 6
        ]);

        // Marais Poitevin => parcs naturels régionaux
        DB::table('categories_lieux')->insert([
            'categorie_id' => 5,
            'lieu_id' => 6
        ]);

        // Plage des Chardons => plages
        DB::table('categories_lieux')->insert([
            'categorie_id' => 1,
            'lieu_id' => 7
        ]);

        // Plage des Conches => plages
        DB::table('categories_lieux')->insert([
            'categorie_id' => 1,
            'lieu_id' => 8
        ]);

        // Parc de Pré Leroy => parcs urbains
        DB::table('categories_lieux')->insert([
            'categorie_id' => 6,
            'lieu_id' => 9
        ]);

        // La Vallée Des Singes => zoos
        DB::table('categories_lieux')->insert([
            'categorie_id' => 8,
            'lieu_id' => 10
        ]);

        // Lieu aléatoire 1 => catégorie 1
        DB::table('categories_lieux')->insert([
            'categorie_id' => 1,
            'lieu_id' => 11
        ]);

        // Lieu aléatoire 2 => catégorie 2
        DB::table('categories_lieux')->insert([
            'categorie_id' => 1,
            'lieu_id' => 12
        ]);

        // Lieu aléatoire 3 => catégorie 3
        DB::table('categories_lieux')->insert([
            'categorie_id' => 3,
            'lieu_id' => 13
        ]);

        // Lieu aléatoire 4 => catégorie 4
        DB::table('categories_lieux')->insert([
            'categorie_id' => 4,
            'lieu_id' => 14
        ]);

        // Lieu aléatoire 5 => catégorie 5
        DB::table('categories_lieux')->insert([
            'categorie_id' => 5,
            'lieu_id' => 15
        ]);

        // Lieu aléatoire 6 => catégorie 6
        DB::table('categories_lieux')->insert([
            'categorie_id' => 6,
            'lieu_id' => 16
        ]);

        // Lieu aléatoire 7 => catégorie 7
        DB::table('categories_lieux')->insert([
            'categorie_id' => 7,
            'lieu_id' => 17
        ]);

        // Lieu aléatoire 8 => catégorie 8
        DB::table('categories_lieux')->insert([
            'categorie_id' => 8,
            'lieu_id' => 18
        ]);

        // Lieu aléatoire 9 => catégorie 9
        DB::table('categories_lieux')->insert([
            'categorie_id' => 9,
            'lieu_id' => 19
        ]);

        // Lieu aléatoire 10 => catégorie 9
        DB::table('categories_lieux')->insert([
            'categorie_id' => 9,
            'lieu_id' => 20
        ]);
    }
}
