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
        // images des catégories

        for ($i = 1; $i < 10; $i++) {
            Image::create([
                'nom' => 'categorie' . $i . '.jpg',
                'mise_en_avant' => true,
                'user_id' => 1,
                'lieu_id' => null
            ]);
        }

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

        // images pour les lieux aléatoires

        for ($i = 11; $i < 111; $i++) {

            Image::create([
                'nom' => 'random.jpg',
                'mise_en_avant' => true,
                'user_id' => 1,
                'lieu_id' => $i
            ]);
        }
    }
}
