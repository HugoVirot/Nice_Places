<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FavoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('favoris')->insert([
                'user_id' => rand(1, 10),
                'lieu_id' => rand(1, 110)
            ]);
        }
    }
}
