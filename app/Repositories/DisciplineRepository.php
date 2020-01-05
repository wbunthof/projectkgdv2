<?php


namespace App\Repositories;


use App\Formonderdelendiscipline;

class DisciplineRepository
{

    protected $discipline;

    public function __construct(Formonderdelendiscipline $discipline)
    {
        $this->discipline = $discipline;
    }

    public function create($attributes)
    {
        return $this->discipline->create($attributes);
    }

    public function all()
    {
        return $this->discipline->all();
    }

    public function find($id)
    {
        return $this->discipline->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->discipline->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->discipline->find($id)->delete();
    }
}
