<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // images des lieux
        Image::create([
            'nom' => 'mervent.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 1
        ]);

        Image::create([
            'nom' => 'parc-des-oiseaux-du-marais.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 2
        ]);

        Image::create([
            'nom' => 'jardin-des-plantes-nantes.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 3
        ]);

        Image::create([
            'nom' => 'zoo-de-la-palmyre.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 4
        ]);

        Image::create([
            'nom' => 'planete-sauvage.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 5
        ]);

        Image::create([
            'nom' => 'marais-poitevin.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 6
        ]);

        Image::create([
            'nom' => 'plage-des-chardons.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 7
        ]);

        Image::create([
            'nom' => 'plage-des-conches.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 8
        ]);

        Image::create([
            'nom' => 'parc-pre-leroy.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 9
        ]);

        Image::create([
            'nom' => 'vallee-des-singes.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => 10
        ]);

        // images des catégories
        
        Image::create([
            'nom' => 'plages.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'forêts et bois.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'lacs et étangs.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'fleuves, rivières et cours d\'eau.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'parcs naturels régionaux.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'parcs urbains.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'randonnées en montagne.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

                
        Image::create([
            'nom' => 'zoos et réserves naturelles.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);

        Image::create([
            'nom' => 'parcs de loisirs et accrobranches.jpg',
            'mise_en_avant' => true,
            'user_id' => 1,
            'lieu_id' => null
        ]);


    }
}
