<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formonderdeel extends Model
{
    public function vraag()
    {
      return $this->hasMany('App\Vraag', 'formonderdeel_id');
    }

    protected $table = 'formOnderdelen';
    protected $fillable = [
        'id', 'onderdeel',
    ];
}
