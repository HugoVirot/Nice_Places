<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lieu;

class LieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insertion de 10 lieux réels
        Lieu::create([
            'nom' => 'Forêt de Mervent',
            'description' => 'La forêt de Mervent-Vouvant ou le massif forestier de 
            Mervent-Vouvant est une forêt située dans le département de la Vendée, 
            en région Pays de la Loire. Avec une superficie de 5 518 hectares, 
            c\'est le plus grand massif forestier de Vendée. (source : Wikipédia)',
            'latitude' => '46.5235',
            'longitude' => '-0.756878',
            'note' => '8.7',
            'temps' => '4',
            'difficulte' => 'amateur',
            'adresse' => 'Forêt Domaniale de Mervent-Vouvant',
            'code_postal' => '85200',
            'ville' => 'Mervent',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 2
        ]);

        Lieu::create([
            'nom' => 'Parc Ornithologique : Les Oiseaux du Marais Poitevin',
            'description' => 'Excursions guidées en barque sur des cours d\'eau pour observer des hérons, 
            film sur les oiseaux de la région et réserve de canards.',
            'latitude' => '46.275605',
            'longitude' => '-0.722044',
            'note' => '8.5',
            'temps' => '3',
            'difficulte' => 'famille',
            'adresse' => 'Le Petit Buisson',
            'code_postal' => '79210',
            'ville' => 'Saint-Hilaire-la-Palud',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 8
        ]);

        Lieu::create([
            'nom' => 'Jardin des Plantes',
            'latitude' => '47.220432',
            'description' => 'Avec 7 hectares de verdure en plein centre-ville, plus de 10 000 espèces vivantes, 800 mètres carrés de serres et plus de 50 000 fleurs 
            plantées chaque saison, le Jardin des Plantes de Nantes, labellisé Jardin Remarquable, figure parmi les quatre grands jardins botaniques de France.
            En 150 ans, les collections se sont enrichies et spécialisées. Une partie de ces collections est cultivée dans d’élégantes serres ouvragées du XIXe siècle.   
            Il est ainsi possible de découvrir le jardin en autonomie (visite libre gratuite des serres avec code d’accès retiré à l’accueil ; jeu de piste gratuit avec 
            manipulation pour toute la famille) ou accompagné d’un jardinier botaniste (visites guidées gratuites).
            Chaque année le Jardin des Plantes accueille près de 2 millions de visiteurs qui viennent également s’y reposer des tumultes de la Ville, ou bien découvrir 
            le mobilier onirique et l’aire de jeux de Claude Ponti, ou encore profiter des animations, concerts et expositions proposées tout au long de l’année.
            (source: https://www.parcsetjardins.fr/jardins/719-jardin-des-plantes-de-nantes)',
            'longitude' => '-1.544265',
            'note' => '8.2',
            'temps' => '2',
            'difficulte' => 'famille',
            'adresse' => 'Rue Stanislas Baudry',
            'code_postal' => '44000',
            'ville' => 'Nantes',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 6
        ]);

        Lieu::create([
            'nom' => 'Zoo de la Palmyre',
            'description' => 'Le zoo de La Palmyre est un parc zoologique français situé sur la côte atlantique de la Nouvelle-Aquitaine, en Charente-Maritime, 
            dans la presqu\'île d\'Arvert, entre Royan et l\'Île d\'Oléron. Créé en 1966 par Claude Caillé, le 
            parc est toujours la propriété de sa famille. Il est actuellement présidé 
            par son fils, Patrick Caillé, et dirigé par son petit-fils Pierre Caillé.
            Il s\'étend sur 18 hectares au sein de la station balnéaire de La Palmyre, 
            enclavée entre la forêt domaniale de la Coubre et la forêt des Combots 
            d\'Ansoine. Le parc, aménagé en jardin paysager, offre au visiteur 
            l\'occasion d\'observer plus de 1 500 animaux de 115 espèces, tout au 
            long d\'un parcours de plus de 4 kilomètres. (source : Wikipédia)',
            'latitude' => '45.682261',
            'longitude' => '-1.167736',
            'note' => '9.1',
            'temps' => '4',
            'difficulte' => 'famille',
            'adresse' => '6 Av. de Royan',
            'code_postal' => '17570',
            'ville' => 'Les Mathes',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 8
        ]);

        Lieu::create([
            'nom' => 'Planète Sauvage',
            'description' => 'Planète Sauvage est un parc zoologique situé sur la côte atlantique française, à Port-Saint-Père, près de Nantes, dans le département 
            de Loire-Atlantique.
            Il couvre une superficie d\'environ quatre-vingt-cinq hectares, dans lesquels vivent environ 1 100 animaux de 120 espèces, et se compose d\'une partie 
            safari visitable en voiture et d\'une partie piétonne qui comprend notamment l\'un des deux delphinariums de France métropolitaine, où sont présentés
            des grands dauphins. (source : Wikipédia)',
            'latitude' => '47.116512',
            'longitude' => '-1.765285',
            'note' => '8.6',
            'temps' => '6',
            'difficulte' => 'famille',
            'adresse' => 'La Chevalerie',
            'code_postal' => '44710',
            'ville' => 'Port-Saint-Père',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 8
        ]);

        Lieu::create([
            'nom' => 'Parc naturel régional du Marais poitevin',
            'description' => 'Le marais poitevin s\'étend sur 3 départements et 100 000 hectares. Il est composé d\'une myriade de petits canaux sur lesquels on peut 
             naviguer en barque. On lui attribue d\'ailleurs le surnom de "Venise Verte" à cause des lentilles qui recouvrent l\'eau.
             Il est également possible de s\'y promener à pied ou à vélo. Les plus jolis villages sont Arçais et Coulon, tous deux dotés d\'embarcadères.
             NB :l\'adresse ci-dessous est celle du siège administratif du Parc.',
             'latitude' => '46.3220216',
             'longitude' => '-0.5859276',
            'note' => '9.3',
            'temps' => '4',
            'difficulte' => 'famille',
            'adresse' => '2 rue de l\'église',
            'code_postal' => '79510',
            'ville' => 'Coulon',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 5
        ]);

        Lieu::create([
            'nom' => 'Plage des Chardons',
            'description' => 'Grande plage de sable fin surveillée en Juillet et Août. Accès à pied par une pinède qui comporte des tables de pique-nique.',
            'latitude' => '46.323139',
            'longitude' => '-1.3229756',
            'note' => '8.5',
            'temps' => '3',
            'difficulte' => 'famille',
            'adresse' => 'Accès 12 - Boulevard de la Forêt',
            'code_postal' => '85460',
            'ville' => ' 85460 L\'AIGUILLON-LA-PRESQU\'ILE',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 1
        ]);

        Lieu::create([
            'nom' => 'Plage des Conches',
            'description' => ' La plage des Conches de Longeville sur Mer est la plus grande plage de la commune. Située dans le village des Conches, 
            on accède à la partie principale de la plage par l’avenue du Docteur Joussemet. En saison, cette zone est surveillée (accès n°13).
            Bordée par d’imposantes dunes, la plage devient rapidement sauvage en s’écartant de l’accès principal. A noter que dans la partie nord 
            on trouve plusieurs campings.
            En allant vers le sud, la plage change de nom et porte le nom de plage de Bud Bud. Cette zone est l’un des plus célèbres spots de 
            surf de la Vendée (souvent comparé aux meilleurs spots de la côte basque et des Landes). Il se trouve entre les accès 14 et 16 (accès par 
            le chemin de Bud mais impossible de stationner, il est conseillé de se garer au niveau du parking de l’accès 13 puis de marcher vers le sud 
            sur 600 mètres).(source : https://www.plages.tv/detail/plage-des-conches-bud-bud-longeville-sur-mer-85560)',
            'latitude' => '46.23334',
            'longitude' => '-1.296334',
            'note' => '8.1',
            'temps' => '2',
            'difficulte' => 'famille',
            'adresse' => 'Avenue du Docteur Joussemet',
            'code_postal' => '85560',
            'ville' => 'Longeville-sur-Mer',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 1
        ]);

        Lieu::create([
            'nom' => 'Parc de Pré Leroy',
            'description' => 'Le parc de Pré-Leroy est situé en centre-ville, en bordure de Sèvre. Il s\'étend sur 2 hectares. 
            Il regroupe une aire de jeux pour les enfants, un parcours d’orientation, un skatepark et une piscine.
            On y accède par les Vieux-Ponts (entrée principale). (source : https://www.vivre-a-niort.com/cadre-de-vie/environnement/parcs-et-jardins/parc-de-pre-leroy/index.html)',
            'latitude' => ' 46.3300424',
            'longitude' => '-0.4632488',
            'note' => '7.9',
            'temps' => '2',
            'difficulte' => 'famille',
            'adresse' => 'Parc de Pré Leroy',
            'code_postal' => '79000',
            'ville' => 'Niort',
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 6
        ]);

        Lieu::create([
            'nom' => 'La Vallée Des Singes',
            'description' => 'La Vallée des Singes est un parc zoologique français situé à Romagne, dans la Vienne. Fondé par le 
            Néerlandais Wim Mager en 1998, vingt-sept ans après avoir fondé le parc Apenheul, le parc présente aujourd\'hui une 
            grande diversité de primates sur des îles végétalisées que le visiteur traverse en circulant au milieu des singes 
            et autres lémuriens. (source : Wikipédia)',
            'latitude' => '46.2702',
            'longitude' => '0.30221',
            'note' => '7.5',
            'temps' => '3',
            'difficulte' => 'famille',
            'adresse' => 'Le Gureau',
            'code_postal' => '86700',
            'ville' => 'Romagne', 
            'user_id' => 1,
            'valide' => true,
            'categorie_id' => 8
        ]);

        // insertion de 10 lieux aléatoires via la LieuFactory (ids 11 à 20)
        // \App\Models\Lieu::factory(10)->create();
    }
}
