<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class vraag extends Model
{
    public function antwoord()
    {
      return $this->hasMany('App\Antwoord');
    }

    public function deelname()
    {
      return $this->hasMany('App\Deelname');
    }

    function gildemis()
    {
      return $this->hasMany('App\Gildemis');
    }

    function optocht()
    {
      return $this->hasMany('App\Optocht');
    }

    function tentoonstelling()
    {
      return $this->hasMany('App\Tentoonstelling');
    }
    function geweer()
    {
      return $this->hasMany('App\Geweer');
    }

    function kruishandboog()
    {
      return $this->hasMany('App\Kruishandboog');
    }

    function standaardrijden()
    {
      return $this->hasMany('App\Standaardrijden');
    }

    protected $table = 'vraag';
    protected $fillable = [
        'tekst', 'formonderdeel', 'type', 'minimumValue', 'maximumValue', 'placeholder',
    ];
}

//
// Einde code van Wouter
//
