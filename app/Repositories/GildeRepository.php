<?php


namespace App\Repositories;

use App\Gilde;
use Illuminate\Support\Facades\DB;

class GildeRepository
{
    protected $gilde;

    public function __construct(Gilde $gilde)
    {
        $this->gilde = $gilde;
    }

    public function create($attributes)
    {
        return $this->gilde->create($attributes);
    }

    public function all()
    {
        return $this->gilde->all();
    }

    public function find($id)
    {
        return $this->gilde->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->gilde->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->gilde->find($id)->delete();
    }

    public function deleteAntwoorden($id)
    {
        return $this->gilde->find($id)->antwoorden()->delete();
    }

    public function deleteLeden($id)
    {
        $tablesVerwijderenNBFS_id = array(
            'bazuinblazen',
            'DeelnameMeerdereWedstrijden',
            'junioren',
            'trommen',
            'vendelen');


        foreach ($tablesVerwijderenNBFS_id as $tabel) {
            DB::table($tabel)->where('NBFS_id', $id)->delete();
        }
        return true;
    }
}
