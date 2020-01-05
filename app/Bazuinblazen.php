<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bazuinblazen
 *
 * @property int $id
 * @property int|null $leden_id
 * @property int $NBFS_id
 * @property string|null $naam
 * @property string|null $geboortedatum
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $Junioren
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @property-read \App\Leden|null $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereJunioren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereSeniorenA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereSeniorenB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereSeniorenC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bazuinblazen whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 */
class Bazuinblazen extends Model
{
  public function leden()
  {
    return $this->belongsTo('App\Leden');
  }

  public function gilde()
  {
    return $this->belongsTo('App\Gilde', 'NBFS_id');
  }

  protected $table = 'bazuinblazen';
  protected $fillable = [
    'lid_id',
    'NBFS_id',
    'naam',
    'geboortedatum',
    'senioren A',
    'senioren B',
    'senioren C',
  ];
}

//
// Einde code van Wouter
//
