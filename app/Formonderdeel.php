<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formonderdeel extends Model
{
    //Relations
    public function vraag()
    {
      return $this->hasMany('App\Vraag', 'formonderdeel_id');
    }

    public function raadsheren()
    {
        return $this->belongsToMany('App\Raadsheer');
    }

    //Atributes
    protected $table = 'formOnderdelen';
    protected $fillable = [
        'id', 'onderdeel', ' vragen', 'leden'
    ];
    protected $casts = ['vragen' => 'boolean',
                        'leden' => 'boolean'];
}
