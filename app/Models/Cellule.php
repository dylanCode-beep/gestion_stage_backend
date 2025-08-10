<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellule extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'code',
        'nom',
        'description',
    ];

    public function stagiaires()
    {
        return $this->hasMany(Stagiaire::class);
    }

    public function encadreurs()
    {
        return $this->hasMany(Encadreur::class);
    }
}
