<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Raadsheer
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Formonderdeel[] $formOnderdelen
 * @property-read int|null $form_onderdelen_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\raadsheerrechten[] $rechten
 * @property-read int|null $rechten_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Raadsheer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Raadsheer extends Authenticatable
{
    use Notifiable;

    public function formOnderdelen() {
        return $this->belongsToMany('App\Formonderdeel');
    }

    protected $guard = 'raadsheer';

    protected $table = 'raadsheer';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}

//
// Einde code van Wouter
//
