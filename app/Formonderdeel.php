<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Formonderdeel
 *
 * @property int $id
 * @property string $onderdeel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $vragen
 * @property bool $leden
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Raadsheer[] $raadsheren
 * @property-read int|null $raadsheren_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vraag[] $vraag
 * @property-read int|null $vraag_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereLeden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereOnderdeel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereVragen($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Formonderdelendiscipline[] $formonderdelendiscipline
 * @property-read int|null $formonderdelendiscipline_count
 * @property-read int|null $leden_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Leden[] $ledenAll
 * @property-read int|null $leden_all_count
 * @property bool $meerderewedstrijden
 * @property bool $junioren
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereJunioren($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Formonderdeel whereMeerderewedstrijden($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Antwoord[] $antwoorden
 * @property-read int|null $antwoorden_count
 */
class Formonderdeel extends Model
{
    //Relations
    public function vraag()
    {
      return $this->hasMany('App\Vraag', 'formonderdeel_id');
    }

    public function formonderdelendiscipline()
    {
        return $this->hasMany('App\Formonderdelendiscipline');
    }

    public function leden()
    {
        return $this->hasManyThrough(
            'App\Leden',
            'App\Formonderdelendiscipline',
            'formonderdeel_id', // Foreign key on Formonderdelendiscipline table...
            'formonderdelendiscipline_id', // Foreign key on leden table...
            'id', // Local key on formonnderdelen table...
            'id' // Local key on Formonderdelendiscipline table...
        );
    }

    public function antwoorden()
    {
        return $this->hasManyThrough(
            'App\Antwoord',
            'App\Vraag',
            'formonderdeel_id',
            'vraag_id'
        );
    }

    public function ledenAll()
    {
        return $this->hasMany('App\Leden');
    }

    public function raadsheren()
    {
        return $this->belongsToMany('App\Raadsheer');
    }

    public function deelnameMeerdereWedstrijden()
    {
        return Deelnamemeerderewedstrijden::query();
    }

    public function junioren()
    {
        return Junioren::query();
    }

    //Atributes
    protected $table = 'formonderdelen';
    protected $fillable = [
        'id', 'onderdeel', ' vragen', 'leden', 'meerdereWedstrijden', 'junioren'
    ];
    protected $casts = ['vragen' => 'boolean',
                        'leden' => 'boolean',
                        'meerderWedstrijden' => 'boolean',
                        'junioren' => 'boolean'];
}
