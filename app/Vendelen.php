<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendelen extends Model
{
  public function leden()
  {
    return $this->belongsTo('App\Leden');
  }

  public function gilde()
  {
    return $this->belongsTo('App\Gilde', 'NBFS_id');
  }

  protected $table = 'vendelen';
  protected $fillable = [
    'lid_id',
    'NBFS_id',
    'naam',
    'geboortedatum',
    'senioren C',
    'senioren C+',
    'senioren Acrobatiek',
    'senioren Zonder Acrobatiek 35 t/m 50 jaar',
    'senioren Zonder Acrobatiek 51+ jaar',
  ];
}

//
// Einde code van Wouter
//
