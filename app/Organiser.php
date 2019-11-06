<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Organiser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'organiser';

    protected $table = 'organiser';

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
