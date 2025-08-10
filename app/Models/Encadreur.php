<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadreur extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id',
        'telephone',
        'num_cni'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cellule()
    {
        return $this->belongsTo(Cellule::class);
    }
}
