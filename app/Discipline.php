<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Discipline
 *
 * @property int $id
 * @property string $discipline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Leden $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereDiscipline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discipline whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $leden_count
 */
class Discipline extends Model
{
  public function leden()
  {
    return $this->hasMany('App\Leden');
  }

  protected $table = 'discipline';
  protected $fillable = [
      'discipline',
      ];
}

//
// Einde code van Wouter
//
