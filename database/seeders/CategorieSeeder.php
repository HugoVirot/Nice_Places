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
            'icone' => '<i class="fa-solid fa-umbrella-beach"></i>',
            'couleur' => '#e6c875'
        ]);

        Categorie::create([  //2
            'nom' => 'forêts et bois',
            'icone' => '<i class="fa-solid fa-tree"></i>',
            'couleur' => '#11ad0e'
        ]);

        Categorie::create([  //3
            'nom' => 'lacs et étangs',
            'icone' => '<i class="fa-solid fa-droplet"></i>',
            'couleur' => '#0e9aad'
        ]);

        Categorie::create([  //4
            'nom' => 'fleuves, rivières et cours d\'eau',
            'icone' => '<i class="fa-solid fa-water"></i>',
            'couleur' => '#0e56ad'
        ]);

        Categorie::create([  //5
            'nom' => 'parcs naturels régionaux',
            'icone' => '<i class="fa-solid fa-signs-post"></i>',
            'couleur' => '#733d0a'
        ]);

        Categorie::create([  //6
            'nom' => 'parcs urbains',
            'icone' => '<i class="fa-solid fa-tree-city"></i>',
            'couleur' => '#6fde2a'
        ]);

        Categorie::create([  //7
            'nom' => 'randonnées en montagne',
            'icone' => '<i class="fa-solid fa-mountain-sun"></i>',
            'couleur' => '#98b5b5'
        ]);

        Categorie::create([  //8
            'nom' => 'zoos et réserves naturelles',
            'icone' => '<i class="fa-solid fa-paw"></i>',
            'couleur' => '#e39d1b'
        ]);

        Categorie::create([  //9
            'nom' => 'parcs de loisirs et accrobranches',
            'icone' => '<i class="fa-solid fa-child-reaching"></i>',
            'couleur' => '#1be3a4'
        ]);
    }
}
