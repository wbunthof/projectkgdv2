<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Formonderdelendiscipline
 *
 * @property int $id
 * @property int $formonderdeel_id
 * @property string $naam
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline whereFormonderdeelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdelendiscipline whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Formonderdeel $formonderdelen
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Leden[] $leden
 * @property-read int|null $leden_count
 * @property-read \App\Formonderdeel $formonderdeel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Junioren[] $junioren
 * @property-read int|null $junioren_count
 */
class Formonderdelendiscipline extends Model
{

    public function formonderdeel()
    {
        return $this->belongsTo('App\Formonderdeel', 'formonderdeel_id', 'id');
    }

    public function leden()
    {
        return $this->hasMany('App\Leden');
    }

    public function junioren()
    {
        return $this->hasMany('App\Junioren', 'juniorenDiscipline_id');
    }

    protected $fillable = [
        'formonderdeel_id',
        'naam'
    ];

}
