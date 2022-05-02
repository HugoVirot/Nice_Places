<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([  //1
            'nom' => 'plages'
        ]);

        Categorie::create([  //2
            'nom' => 'forêts et bois'
        ]);

        Categorie::create([  //3
            'nom' => 'lacs'
        ]);

        Categorie::create([  //4
            'nom' => 'fleuves, rivières et cours d\'eau'
        ]);

        Categorie::create([  //5
            'nom' => 'parcs naturels régionaux'
        ]);

        Categorie::create([  //6
            'nom' => 'parcs urbains'
        ]);

        Categorie::create([  //7
            'nom' => 'randonnées en montagne'
        ]);

        Categorie::create([  //8
            'nom' => 'zoos et réserves naturelles'
        ]);

        Categorie::create([  //9
            'nom' => 'parcs de loisirs / accrobranches'
        ]);
    }
}
