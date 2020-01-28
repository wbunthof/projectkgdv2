<?php


namespace App\Services;

use App\Repositories\GildeRepository;
use Illuminate\Http\Request;
use Hash;
use Str;

class GildeService
{
    public function __construct(GildeRepository $gilde)
    {
        $this->gilde = $gilde ;
    }

    public function index()
    {
        return $this->gilde->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();
        return $this->gilde->create($attributes);
    }

    public function read($id)
    {
        return $this->gilde->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->gilde->update($id, $attributes);
    }

    public function delete($id)
    {
        //Deze tabllen hebben leden dus moet er verwijderd worden in de pivot tables

        $this->gilde->deleteLeden($id);
        $this->gilde->deleteAntwoorden($id);

        return $this->gilde->delete($id);
    }

    public function newPassword($id)
    {
        $password = Str::random(8);
        $this->gilde->update($id, ['password' => Hash::make($password)]);
        return $password;
    }
}

