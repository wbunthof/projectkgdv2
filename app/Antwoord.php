<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antwoord extends Model
{
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
        return $this->belongsTo('App\Formonderdeel');
    }

    protected $table = 'antwoorden';
    protected $fillable = [
      'NBFS', 'vraag_id', 'antwoord',
    ];
}
