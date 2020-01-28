<?php
//
// Begin code van Wouter
//

namespace App;

use App\Factory\UpdateAccountFactory;
use App\Http\Controllers\AdminController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * App\Gilde
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $locatie
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Antwoord[] $antwoorden
 * @property-read int|null $antwoorden_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Bazuinblazen[] $bazuinblazen
 * @property-read int|null $bazuinblazen_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Deelnamemeerderewedstrijden[] $deelnamMeerdereWedstrijden
 * @property-read int|null $deelnam_meerdere_wedstrijden_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Junioren[] $junioren
 * @property-read int|null $junioren_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Trommen[] $trommen
 * @property-read int|null $trommen_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vendelen[] $vendelen
 * @property-read int|null $vendelen_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereLocatie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Leden[] $leden
 * @property-read int|null $leden_count
 * @property string|null $last_login_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Log[] $logs
 * @property-read int|null $logs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gilde whereLastLoginAt($value)
 */
class Gilde extends Authenticatable
{
    use Notifiable;

    static function updateAccount(Gilde $gilde, $onderdeel, $antwoord){
       $update = new UpdateAccountFactory;
        $update->updateAccount($gilde, $onderdeel, $antwoord);
    }

    //Relations
    public function antwoorden()
    {
      return $this->hasMany('App\Antwoord', 'NBFS', 'id');
    }

    public function leden()
    {
        return $this->hasMany('App\Leden');
    }

    public function deelnamMeerdereWedstrijden()
    {
      return $this->hasMany('App\Deelnamemeerderewedstrijden', 'NBFS_id');
    }

    public function junioren()
    {
      return $this->hasMany('App\Junioren', 'NBFS_id');
    }

    protected $guard = 'gilde';

    protected $fillable = [
        'id', 'name', 'email', 'password', 'locatie', 'last_login_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $table = 'gilde';
}

//
// Einde code van Wouter
//
