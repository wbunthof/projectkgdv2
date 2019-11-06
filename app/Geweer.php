<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class geweer extends Model
{
  public function gilde()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  protected $table = 'geweer';
  protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
  ];
}

//
// Einde code van Wouter
//
