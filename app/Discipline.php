<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
  public function leden()
  {
    return $this->hasOne('App\Leden');
  }

  protected $table = 'discipline';
  protected $fillable = [
      'discipline',
      ];
}

//
// Einde code van Wouter
//
