<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function logable()
    {
        return $this->morphTo();
    }
}
