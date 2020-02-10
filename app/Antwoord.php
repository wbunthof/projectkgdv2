<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Antwoord
 *
 * @property int $id
 * @property int $NBFS
 * @property int $vraag_id
 * @property string|null $antwoord
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Formonderdeel $formOnderdeel
 * @property-read \App\Gilde $gilden
 * @property-read \App\Vraag $vraag
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Antwoord onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereAntwoord($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereNBFS($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Antwoord whereVraagId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Antwoord withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Antwoord withoutTrashed()
 * @mixin \Eloquent
 */
class Antwoord extends Model
{
    use SoftDeletes;

    static function perOnderdeelPerGilde($NBFS) {
        $vragenPerOnderdeel = array();
        foreach (Formonderdeel::all() as $onderdeel) {
            array_push($vragenPerOnderdeel, array($onderdeel->onderdeel, Antwoord::with(['vraag' => function ($query) use ($onderdeel) {
                $query->where('formonderdeel_id', $onderdeel->id);
            }])->where('NBFS', $NBFS)->get()));
        }

        return $vragenPerOnderdeel;

    }


    //Relations
    public function gilden()
    {
        return $this->belongsTo('App\Gilde', 'NBFS');
    }

    public function vraag()
    {
        return $this->belongsTo('App\Vraag');
    }

    public function formOnderdeel()
    {
        return $this->vraag->formOnderdeel();
    }

    protected $table = 'antwoorden';
    protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
    ];
}
