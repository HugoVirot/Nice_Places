<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            RegionSeeder::class,
            DepartementSeeder::class,
            UserSeeder::class,
            CategorieSeeder::class,
            LieuSeeder::class,
            AvisSeeder::class,
            FavoriSeeder::class,
            ImageSeeder::class,
            NotificationSeeder::class
        ]);
    }
}
