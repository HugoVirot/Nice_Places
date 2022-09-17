<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $with = ['region'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function lieu()
    {
        return $this->hasMany(Lieu::class);
    }
}
