<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Junioren
 *
 * @property int $id
 * @property string $voornaam
 * @property string $achternaam
 * @property string $geboortedatum
 * @property int $NBFS_id
 * @property int $juniorenDiscipline_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\JuniorenDiscipline $juniorenDiscipline
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereAchternaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereJuniorenDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Junioren whereVoornaam($value)
 * @mixin \Eloquent
 */
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
