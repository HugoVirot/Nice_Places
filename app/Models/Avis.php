<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
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

    protected $with = ['user', 'lieu'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lieu_id',
        'note',
        'commentaire',
        'statut'
    ];
}
