<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Vendelen
 *
 * @property int $id
 * @property int|null $leden_id
 * @property int $NBFS_id
 * @property string|null $naam
 * @property string|null $geboortedatum
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @property int $Junioren
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @property-read \App\Leden|null $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereJunioren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenAcrobatiek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 * @property int $senioren C
 * @property int $senioren C+
 * @property int $senioren Acrobatiek
 * @property int $senioren Zonder Acrobatiek 35 t/m 50 jaar
 * @property int $senioren Zonder Acrobatiek 51+ jaar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenC+($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek35T/m50Jaar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vendelen whereSeniorenZonderAcrobatiek51+Jaar($value)
 */
class Vendelen extends Model
{
  public function leden()
  {
    return $this->belongsTo('App\Leden');
  }

  public function gilde()
  {
    return $this->belongsTo('App\Gilde', 'NBFS_id');
  }

  protected $table = 'vendelen';
  protected $fillable = [
    'lid_id',
    'NBFS_id',
    'naam',
    'geboortedatum',
    'senioren C',
    'senioren C+',
    'senioren Acrobatiek',
    'senioren Zonder Acrobatiek 35 t/m 50 jaar',
    'senioren Zonder Acrobatiek 51+ jaar',
  ];
}

//
// Einde code van Wouter
//
