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
        'tekst', 'type', 'minimumValue', 'maximumValue', 'placeholder', 'formonderdeel_id'
    ];
}

//
// Einde code van Wouter
//
