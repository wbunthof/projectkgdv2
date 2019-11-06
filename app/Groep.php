<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
  public function gilde()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  protected $table = 'groep';
  protected $fillable = [
      'NBFS',
      'vraag_id',
      'antwoord',
  ];
}
