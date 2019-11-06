<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class deelname extends Model
{
  public function gilden()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  protected $table = 'deelname';
  protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
  ];
}

//
// Einde code van Wouter
//
