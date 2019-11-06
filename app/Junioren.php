<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Junioren extends Model
{
  public function juniorenDiscipline()
  {
    return $this->belongsTo('App\JuniorenDiscipline', 'juniorenDiscipline_id');
  }

  public function gilde($value='')
  {
    return $this->belongsTo('App\Gilde', 'NBFS_id');
  }
  protected $table = 'junioren';
  protected $fillable = [
      'voornaam',
      'achternaam',
      'geboortedatum',
      'NBFS_id',
      'juniorenDiscipline_id',
  ];
}
