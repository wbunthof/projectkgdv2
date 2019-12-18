<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vraag extends Model
{
    static function perOnderdeel(Formonderdeel $onderdeel) {
        return Vraag::where('formonderdeel_id', $onderdeel->id)->get();
    }

    //Relations
    public function antwoord()
    {
        return $this->hasMany('App\Antwoord');
    }

    public function formOnderdeel() {
        return $this->belongsTo('App\Formonderdeel');
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
        'tekst', 'formonderdeel', 'type', 'minimumValue', 'maximumValue', 'placeholder',
    ];
}

//
// Einde code van Wouter
//
