<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Vraag
 *
 * @property int $id
 * @property string $tekst
 * @property string|null $extraInfo
 * @property string|null $placeholder
 * @property string|null $minimumValue
 * @property string|null $maximumValue
 * @property string|null $type
 * @property int $verplicht
 * @property int $formonderdeel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Antwoord[] $antwoord
 * @property-read int|null $antwoord_count
 * @property-read \App\Formonderdeel $formOnderdeel
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Vraag onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereExtraInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereFormonderdeelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereMaximumValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereMinimumValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag wherePlaceholder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereTekst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vraag whereVerplicht($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vraag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vraag withoutTrashed()
 * @mixin \Eloquent
 */
class Vraag extends Model
{
    use SoftDeletes;

    static function perOnderdeel(Formonderdeel $onderdeel) {
        return Vraag::where('formonderdeel_id', $onderdeel->id)->get();
    }

    //Relations
    public function antwoord()
    {
        return $this->hasMany('App\Antwoord');
    }

    public function formOnderdeel() {
        return $this->belongsTo('App\Formonderdeel', 'formonderdeel_id', 'id');
    }

    public function setTypeAttribute($value)
    {
        switch ($value) {
            case 'B':
                $this->attributes['type'] = 'boolean';
                break;
            case 'T':
                $this->attributes['type'] = 'text';
                break;
            case 'TA':
                $this->attributes['type'] = 'textarea';
                break;
            case 'N':
                $this->attributes['type'] = 'number';
                break;
            default:
                $this->attributes['type'] =  $value;
                break;

        }
    }

    public function getTypeAttribute($value)
    {
        switch ($value) {
        case 'B':
                return 'boolean';
                break;
            case 'T':
                return'text';
                break;
            case 'TA':
                return'textarea';
                break;
            case 'N':
                return'number';
                break;
            default:
                return $value;
                break;

        }
    }

    protected $table = 'vraag';
    protected $fillable = [
        'tekst', 'extraInfo', 'type', 'minimumValue', 'maximumValue', 'placeholder', 'formonderdeel_id', 'type',
    ];
}

//
// Einde code van Wouter
//
