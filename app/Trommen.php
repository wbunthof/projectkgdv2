<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Trommen
 *
 * @property int $id
 * @property int|null $leden_id
 * @property int $NBFS_id
 * @property string|null $naam
 * @property string|null $geboortedatum
 * @property int '$senioren U'
 * @property int '$senioren A'
 * @property int '$senioren B'
 * @property int '$senioren C'
 * @property int '$senioren E'
 * @property int '$Junioren muziektrom'
 * @property int '$Junioren gildetrom'
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @property-read \App\Leden|null $leden
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereGeboortedatum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereJuniorenGildetrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereJuniorenMuziektrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereLedenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenE($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereSeniorenU($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Trommen whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int '$senioren U'
 * @property int '$senioren A'
 * @property int '$senioren B'
 * @property int '$senioren C'
 * @property int '$senioren E'
 * @property int '$Junioren muziektrom'
 * @property int '$Junioren gildetrom'
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 * @property int $senioren U
 * @property int $senioren A
 * @property int $senioren B
 * @property int $senioren C
 * @property int $senioren E
 * @property int $Junioren muziektrom
 * @property int $Junioren gildetrom
 */
class Trommen extends Model
{
    public function leden()
    {
        return $this->belongsTo('App\Leden');
    }

    public function ledenMorph()
    {

    }

    public function gilde()
    {
        return $this->belongsTo('App\Gilde', 'NBFS_id');
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    protected $table = 'trommen';
    protected $fillable = [
    'lid_id',
    'NBFS_id',
    'naam',
    'geboortedatum',
    'senioren A',
    'senioren B',
    'senioren C',
    ];
}

//
// Einde code van Wouter
//
