<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antwoord extends Model
{
  public function gilden()
  {
    return $this->belongsTo('App\Gilde', 'NBFS');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  public function formOnderdeel()
  {
    return $this->belongsTo('App\Formonderdeel');
  }

  protected $table = 'antwoorden';
  protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
  ];
}
