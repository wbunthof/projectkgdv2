<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class tentoonstelling extends Model
{
  public function tentoonstelling()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  protected $table = 'tentoonstelling';
  protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
  ];
}

//
// Einde code van Wouter
//
