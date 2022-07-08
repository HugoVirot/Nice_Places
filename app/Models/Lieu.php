<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;
    // chargement automatique des catégories / images / user / avis associés lorsque l'on récupère le lieu
    protected $with = ['categories', 'images', 'user', 'avis'];  
                                       
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categories_lieux');
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
        'adresse',
        'code_postal',
        'ville',
        'user_id',
        'valide'
    ];
}
