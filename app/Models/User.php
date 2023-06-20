<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash ;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'password_confirmation'
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


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($user) {
    //         if (!empty($user->password)) {
    //             $user->password = Hash::make($user->password);
    //             $user->password_confirmation = Hash::make($user->password_confirmation);
    //         }
    //     });
    // }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function commandes()
    {

        return $this->hasMany(Commande::class);
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    public function points()
    {
        return $this->hasOne(Point::class);
    }

    public function retraits()
    {
        return $this->hasMany(Retrait::class);
    }
}
