<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Deelnamemeerderewedstrijden
 *
 * @property int $id
 * @property int $NBFS_id
 * @property int|null $discipline_id
 * @property string $naam
 * @property string $disciplines
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Gilde $gilde
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereDisciplines($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereNBFSId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereNaam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Deelnamemeerderewedstrijden whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Deelnamemeerderewedstrijden extends Model
{
  public function gilde()
  {
    return $this->belongsTo('App\Gilde', 'NBFS_id');
  }

  public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

  protected $table = 'DeelnameMeerdereWedstrijden';
  protected $fillable = [
    'NBFS_id',
    'naam',
    'disciplines',
  ];
}

//
// Einde code van Wouter
//
