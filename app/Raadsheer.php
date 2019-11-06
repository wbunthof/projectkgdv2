<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Raadsheer extends Authenticatable
{
    use Notifiable;

     public function rechten()
     {
       return $this->hasMany('App\Raadsheerrechten');
     }

    protected $guard = 'raadsheer';

    protected $table = 'raadsheer';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

//
// Einde code van Wouter
//
