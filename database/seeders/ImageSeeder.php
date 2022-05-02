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
            'nom' => 'oiseauxdumarais.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 2
        ]);

        Image::create([
            'nom' => 'jardindesplantesnantes.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 3
        ]);

        Image::create([
            'nom' => 'zoodelapalmyre.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 4
        ]);

        Image::create([
            'nom' => 'planetesauvage.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 5
        ]);

        Image::create([
            'nom' => 'maraispoitevin.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 6
        ]);

        Image::create([
            'nom' => 'plagedeschardons.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 7
        ]);

        Image::create([
            'nom' => 'plagedesconches.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 8
        ]);

        Image::create([
            'nom' => 'parcpreleroy.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 9
        ]);

        Image::create([
            'nom' => 'valleedessinges.jpg',
            'profil' => false,
            'user_id' => 1,
            'lieu_id' => 10
        ]);
    }
}
