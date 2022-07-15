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
        Image::create([
            'nom' => 'mervent.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 1
        ]);

        Image::create([
            'nom' => 'parc-des-oiseaux-du-marais.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 2
        ]);

        Image::create([
            'nom' => 'jardin-des-plantes-nantes.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 3
        ]);

        Image::create([
            'nom' => 'zoo-de-la-palmyre.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 4
        ]);

        Image::create([
            'nom' => 'planete-sauvage.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 5
        ]);

        Image::create([
            'nom' => 'marais-poitevin.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 6
        ]);

        Image::create([
            'nom' => 'plage-des-chardons.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 7
        ]);

        Image::create([
            'nom' => 'plage-des-conches.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 8
        ]);

        Image::create([
            'nom' => 'parc-pre-leroy.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 9
        ]);

        Image::create([
            'nom' => 'vallee-des-singes.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 10
        ]);
    }
}
