<?php
//
// Begin code van Wouter
//

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trommen extends Model
{
  public function leden()
  {
    return $this->belongsTo('App\Leden');
  }

  public function gilde()
  {
    return $this->belongsTo('App\Gilde', 'NBFS_id');
  }

  public function getTableColumns() {
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
