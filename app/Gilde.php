<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Gilde extends Authenticatable
{
    use Notifiable;

    static function updateAccount(Gilde $gilde, $onderdeel, $antwoord){
        if (Schema::hasColumn('gilde', $onderdeel)){

            $gilde->$onderdeel = $antwoord;
            $gilde->save();
            return true;

        } else {
            Log::warning('A user tried to update his personal info, but somehow the application wanted to update an non existing column. Look into the App/Gilde.php model @updateAccount funtion');
            return false;
        }
    }

    //Relations
    public function antwoorden()
    {
      return $this->hasMany('App\Antwoord', 'NBFS');
    }

    public function deelname()
    {
      return $this->hasMany('App\Deelname');
    }

    public function gildemis()
    {
      return $this->hasMany('App\Gildemis');
    }

    public function optocht()
    {
      return $this->hasMany('App\Optocht');
    }

    public function tentoonstelling()
    {
      return $this->hasMany('App\Tentonstelling');
    }

    public function bazuinblazen()
    {
      return $this->hasMany('App\Bazuinblazen', 'NBFS_id');
    }

    public function geweer()
    {
      return $this->hasMany('App\Geweer');
    }

    public function kruishandboog()
    {
      return $this->hasMany('App\Kruishandboog');
    }

    public function standaardrijden()
    {
      return $this->hasMany('App\Standaardrijden');
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
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $table = 'Gilde';
}

//
// Einde code van Wouter
//
