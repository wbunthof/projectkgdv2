<?php


namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminService
{
    protected $admin;

    public function __construct(AdminRepository $admin)
    {
        $this->admin = $admin ;
    }

    public function index()
    {
        return $this->admin->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();
        $attributes["password"] = Hash::make(Str::random(8));

        return $this->admin->create($attributes);
    }

    public function read($id)
    {
        return $this->admin->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->admin->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->admin->delete($id);
    }

    public function newPassword($id)
    {
        return $this->admin->update($id, ['password' => Hash::make(Str::random(8))]);
    }
}
