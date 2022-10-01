<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // pour pouvoir créer de nouveaux rôles dans une future version
    protected $fillable = [
        'role'
    ];
}
