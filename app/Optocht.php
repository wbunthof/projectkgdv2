<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class optocht extends Model
{
  public function optocht()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

    protected $table = 'optocht';
    protected $fillable = [
        'NBFS', 'vraag_id', 'antwoord',
    ];
}

//
// Einde code van Wouter
//
