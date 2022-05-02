<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lieu extends Model
{
    use HasFactory;

    protected $with = ['categories'];  // chargement automatique des catégories associées
                                       // lorsque l'on récupère le lieu
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
}
