<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lieu()
    {
        return $this->belongsTo(Lieu::class);
    }

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'user_id',
        'lieu_id',
        'profil',
        'longueur',
        'largeur',
        'taille',
        'mise_en_avant'
    ];

    protected $with = ['user'];
}
