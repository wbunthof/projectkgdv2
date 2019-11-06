<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leden extends Model
{
  public function discipline()
  {
    return $this->belongsTo('App\Discipline');
  }

  public function bazuinblazen()
  {
    return $this->hasOne('App\Bazuinblazen');
  }

  public function trommen()
  {
    return $this->hasOne('App\Trommen');
  }

  public function vendelen()
  {
    return $this->hasOne('App\Vendelen');
  }

  protected $table = 'leden';
  protected $fillable = [
      'leden_id',
      'voorletter',
      'voornaam',
      'tussenvoegsel',
      'achternaam',
      'geboortedatum',
      'discipline_id',
      'straat',
      'huisnummer',
      'plaats',
      'gemaakt_NBFS',
      'gemaakt_raadsheer',
  ];
}
