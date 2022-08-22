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
            'nom' => 'plages',
            'icone' => '<i class="fa-solid fa-umbrella-beach"></i>'
        ]);

        Categorie::create([  //2
            'nom' => 'forêts et bois',
            'icone' => '<i class="fa-solid fa-tree"></i>'
        ]);

        Categorie::create([  //3
            'nom' => 'lacs et étangs',
            'icone' => '<i class="fa-solid fa-water"></i>'
        ]);

        Categorie::create([  //4
            'nom' => 'fleuves, rivières et cours d\'eau',
            'icone' => '<i class="fa-solid fa-droplet"></i>'
        ]);

        Categorie::create([  //5
            'nom' => 'parcs naturels régionaux',
            'icone' => '<i class="fa-solid fa-signs-post"></i>'
        ]);

        Categorie::create([  //6
            'nom' => 'parcs urbains',
            'icone' => '<i class="fa-solid fa-tree-city"></i>'
        ]);

        Categorie::create([  //7
            'nom' => 'randonnées en montagne',
            'icone' => '<i class="fa-solid fa-mountains"></i>'
        ]);

        Categorie::create([  //8
            'nom' => 'zoos et réserves naturelles',
            'icone' => '<i class="fa-solid fa-paw"></i>'
        ]);

        Categorie::create([  //9
            'nom' => 'parcs de loisirs et accrobranches',
            'icone' => '<i class="fa-solid fa-squirrel"></i>'
        ]);
    }
}
