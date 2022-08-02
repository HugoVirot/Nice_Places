<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notification::create([
            'titre' => 'Bienvenue sur Nice Places',
            'message' => 'Bonjour,<br>
            Ton inscription a bien été validée.<br>
            On te souhaite la bienvenue sur Nice Places !<br>
            A très vite.<br>
            L\'administrateur',
            'user_id' => 1,
            'lieu_id' => null
        ]);

        Notification::create([
            'titre' => 'Ton lieu a été accepté',
            'message' => 'Bonjour,<br>
            Ton lieu a bien été validé !<br>
            Merci pour ce partage.<br>
            Tu peux déjà le retrouver sur la carte ou dans ton onglet "mes lieux postés" !<br>
            A très vite.<br>
            L\'administrateur',
            'user_id' => 1,
            'lieu_id' => 3
        ]);

        Notification::create([
            'titre' => 'Ton lieu n\'a pas été accepté',
            'message' => 'Bonjour,<br>
            Ton lieu n\'a pas été validé pour la raison suivante : <br>
            Lieu déjà existant
            Merci quand même et à très vite.<br>
            L\'administrateur',
            'user_id' => 1,
            'lieu_id' => null
        ]);
    }
}
