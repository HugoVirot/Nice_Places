<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // création de l'administrateur
        User::create([
            'pseudo' => 'administrateur',
            'password' => Hash::make('Azerty88@'), 
            'email' => 'admin@niceplaces.fr',
            'email_verified_at' => now(),
            'departement' => '79',
            'remember_token' => Str::random(10),
            'role_id' => 2
        ]);

        // création de 9 users aléatoires
        \App\Models\User::factory(9)->create();
    }
}
