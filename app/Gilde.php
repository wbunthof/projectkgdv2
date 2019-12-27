<?php
//
// Begin code van Wouter
//

namespace App;

use App\Factory\UpdateAccountFactory;
use App\Http\Controllers\AdminController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class Gilde extends Authenticatable
{
    use Notifiable;

    static function updateAccount(Gilde $gilde, $onderdeel, $antwoord){
       $update = new UpdateAccountFactory;
        $update->updateAccount($gilde, $onderdeel, $antwoord);
    }

    //Relations
    public function antwoorden()
    {
      return $this->hasMany('App\Antwoord', 'NBFS', 'id');
    }

    public function bazuinblazen()
    {
      return $this->hasMany('App\Bazuinblazen', 'NBFS_id');
    }

    public function trommen()
    {
      return $this->hasMany('App\Trommen', 'NBFS_id');
    }

    public function vendelen()
    {
      return $this->hasMany('App\Vendelen', 'NBFS_id');
    }

    public function deelnamMeerdereWedstrijden()
    {
      return $this->hasMany('App\Deelnamemeerderewedstrijden', 'NBFS_id');
    }

    public function junioren()
    {
      return $this->hasMany('App\Junioren', 'NBFS_id');
    }

    protected $guard = 'gilde';

    protected $fillable = [
        'id', 'name', 'email', 'password', 'locatie',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $table = 'Gilde';
}

//
// Einde code van Wouter
//
