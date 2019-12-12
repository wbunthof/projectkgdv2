<?php


namespace App\Repositories;

use App\Raadsheer;

class RaadsheerRepository
{

    protected $raadsheer;

    public function __construct(Raadsheer $raadsheer)
    {
        $this->raadsheer = $raadsheer;
    }

    public function create($attributes)
    {
        return $this->raadsheer->create($attributes);
    }

    public function all()
    {
        return $this->raadsheer->all();
    }

    public function find($id)
    {
        return $this->raadsheer->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->raadsheer->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->raadsheer->find($id)->delete();
    }
}
