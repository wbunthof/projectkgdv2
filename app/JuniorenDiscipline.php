<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\JuniorenDiscipline
 *
 * @property int $id
 * @property string $klasse
 * @property int $discipline_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Junioren[] $Junioren
 * @property-read int|null $junioren_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereKlasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JuniorenDiscipline whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
