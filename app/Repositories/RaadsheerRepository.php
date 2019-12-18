<?php


namespace App\Repositories;

use App\Raadsheer;
use Exception;

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

    public function updateFormonderdelen($id, array $onderdelen)
    {
        $this->raadsheer->find($id)->formOnderdelen()->sync($onderdelen);
    }

    /**
     * @param $id
     * @return bool|Exception|null
     */
    public function delete($id)
    {
        $this->raadsheer->find($id)->formOnderdelen()->detach();
        try {
            return $this->raadsheer->find($id)->delete();
        } catch (Exception $e) {
            return $e;
        }

    }
}
