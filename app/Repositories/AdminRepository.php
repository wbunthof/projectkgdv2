<?php


namespace App\Repositories;

use App\Admin;

class AdminRepository
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function create($attributes)
    {
        return $this->admin->create($attributes);
    }

    public function all()
    {
        return $this->admin->all();
    }

    public function find($id)
    {
        return $this->admin->find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->admin->find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->admin->find($id)->delete();
    }
}
