<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class vraag extends Model
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

    protected $table = 'vraag';
    protected $fillable = [
        'tekst', 'formonderdeel', 'type', 'minimumValue', 'maximumValue', 'placeholder',
    ];
}

//
// Einde code van Wouter
//
