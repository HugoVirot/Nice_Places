<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function favoris()
    {
        return $this->belongsToMany(Lieu::class, 'favoris');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function lieux(){
        return $this->hasMany(Lieu::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pseudo',
        'password',
        'email',
        'departement'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
