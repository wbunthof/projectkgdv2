<?php


namespace App\Repositories;


use App\Leden;

class LedenRepository
{

    protected $leden;

    public function __construct(Leden $leden)
    {
        $this->leden = $leden;
    }

    public function create($attributes)
    {
        return $this->leden->create($attributes);
    }

    public function all()
    {
        return $this->leden->all();
    }

    public function find($id)
    {
        return $this->leden->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->leden->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->leden->find($id)->delete();
    }

    public function deleteFormonderdelenDisciplines($id)
    {
        $lid = $this->leden->find($id);
        $lid->formonderdelendiscipline_id = null;
        return $lid->save();
    }
}
