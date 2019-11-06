<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class gildemis extends Model
{
  public function gildemis()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  protected $table = 'gildemis';
  protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
  ];
}

//
// Einde code van Wouter
//
