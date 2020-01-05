<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Organiser
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organiser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Organiser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'organiser';

    protected $table = 'organiser';

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
