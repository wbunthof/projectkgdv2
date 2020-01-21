<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Leden
 *
 * @property int $id
 * @property int $leden_id
 * @property string $voorletter
 * @property string $voornaam
 * @property string|null $tussenvoegsel
 * @property string $achternaam
 * @property string $geboortedatum
 * @property int $discipline_id
 * @property string|null $straat
 * @property string|null $huisnummer
 * @property string|null $plaats
 * @property int|null $gemaakt_NBFS
 * @property int|null $gemaakt_raadsheer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Bazuinblazen $bazuinblazen
 * @property-read \App\Discipline $discipline
 * @property-read \App\Trommen $trommen
 * @property-read \App\Vendelen $vendelen
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereAchternaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGemaaktNBFS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGemaaktRaadsheer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereHuisnummer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden wherePlaats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereStraat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereTussenvoegsel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereVoorletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereVoornaam($value)
 * @mixin \Eloquent
 * @property int $idOld
 * @property int $formonderdeel_id
 * @property int|null $formonderdelendiscipline_id
 * @property int|null $gilde_id
 * @property-read \App\Gilde|null $gilde
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereFormonderdeelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereFormonderdelendisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereGildeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Leden whereIdOld($value)
 * @property-read \App\Formonderdeel $formonderdeel
 */
class Leden extends Model
{
    public function discipline()
    {
    //      return $this->belongsToMany('App\Discipline', 'formonderdelendisciplines_leden', 'leden_id', 'formonderdelendisciplines_id');
        return $this->belongsTo('App\Formonderdelendiscipline', 'formonderdelendiscipline_id');
    }

    public function bazuinblazen()
    {
        return $this->hasOne('App\Bazuinblazen');
    }

    public function trommen()
    {
        return $this->hasOne('App\Trommen');
    }

    public function vendelen()
    {
        return $this->hasOne('App\Vendelen');
    }

     public function gilde()
    {
        return $this->belongsTo('App\Gilde');
    }

    public function formonderdeel()
    {
        return $this->belongsTo('App\Formonderdeel');
    }

//    /**
//     * @param $value
//     * @return float|int
//     */
//    public function getIdAttribute($value)
//    {
//        return $value - 100000 * $this->attributes['formonderdeel_id'];
//    }
//
//    public function setIdAttribute($value)
//    {
////        dump( $value, $value + 100000 * $this->attributes['formonderdeel_id']);
//        $this->attributes['id'] = $value + 100000 * $this->attributes['formonderdeel_id'];
//    }


  protected $table = 'leden';
  protected $fillable = [
      'leden_id',
      'voorletter',
      'voornaam',
      'tussenvoegsel',
      'achternaam',
      'geboortedatum',
      'formonderdelendiscipline_id',
      'straat',
      'huisnummer',
      'plaats',
      'gilde_id',
      'gemaakt_raadsheer',
      'formonderdeel_id',
  ];
}
