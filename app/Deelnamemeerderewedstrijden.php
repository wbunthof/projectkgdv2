<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

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
