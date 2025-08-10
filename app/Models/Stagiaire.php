<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Stagiaire extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id',
        'code',
        'etablissement',
        'filiere',
        'niveau',
        'sexe',
        'datenaissance',
        'telephone',

    ];

    public function cellule()
    {
        return $this->belongsTo(Cellule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}


