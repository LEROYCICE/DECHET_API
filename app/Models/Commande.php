<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    public function categorie(){

        return $this->belongsTo(Category::class) ;
    }

    public function users(){
        return $this->belongsTo(User::class) ;
    }

    public function livraison()
    {
       return $this->hasOne(Livraison::class) ;
    }
}
