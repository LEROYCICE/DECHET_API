<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function commandes(){

        return $this->hasMany(Commande::class) ;
    }

    public function livraisons(){

        return $this->hasMany(Livraison::class) ;
    }
}
