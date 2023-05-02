<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    public function categorie(){

        return $this->belongsTo(Category::class) ;
    }

    public function user(){

        return $this->belongsTo(User::class) ;
    }
}
