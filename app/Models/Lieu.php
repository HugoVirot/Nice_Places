<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;

    // chargement automatique des catégories / images / user associés lorsque l'on récupère le lieu
    // les avis ne sont pas inclus car tri par date de publication (le dernier en 1er) nécessaire 
    // => récupération et tri réalisés dans le contrôleur
    protected $with = ['categorie', 'user', 'image_mise_en_avant', 'departement'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'favoris');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function image_mise_en_avant()
    {
        return $this->hasMany(Image::class)->where('mise_en_avant', true);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'description',
        'latitude',
        'longitude',
        'note',
        'temps',
        'difficulte',
        'categorie_id',
        'kilometres',
        'departement_id',
        'adresse',
        'code_postal',
        'ville',
        'user_id',
        'statut',
        'commentaire'
    ];
}
