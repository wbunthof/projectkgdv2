<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class kruishandboog extends Model
{
  public function KruisHandboog()
  {
    return $this->belongsTo('App\Gilde');
  }

  public function vraag()
  {
    return $this->belongsTo('App\Vraag');
  }

  protected $table = 'Kruis-handboog';
  protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
  ];
}

//
// Einde code van Wouter
//
