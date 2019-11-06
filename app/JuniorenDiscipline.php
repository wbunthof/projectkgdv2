<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JuniorenDiscipline extends Model
{
  public function Junioren()
  {
    return $this->hasMany(Junioren::class, 'juniorenDiscipline_id');
  }

  // public function discipline()
  // {
  //   return $this->hasOne('App\Discipline');
  // }

  protected $table = 'juniorenDiscipline';
  protected $fillable = [
      'klasse',
      'discipline_id',
  ];
}
