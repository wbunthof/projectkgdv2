<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Log
 *
 * @property int $id
 * @property string $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $logable_id
 * @property string $logable_type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $logable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereLogableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereLogableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Log extends Model
{
    public function logable()
    {
        return $this->morphTo();
    }

//    public function raadsheer()
//    {
//        return $this->morphedByMany('App\Raadsheer', 'log');
//    }

    protected $fillable = ['action'];
}
