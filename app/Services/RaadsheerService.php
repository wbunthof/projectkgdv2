<?php


namespace App\Services;


use App\Formonderdeel;
use App\Raadsheer;
use App\Repositories\RaadsheerRepository;
use Hash;
use Illuminate\Http\Request;
use Str;


class RaadsheerService
{

    protected $raadsheerRepository;
    protected $raadsheer;

    public function __construct(RaadsheerRepository $Repositoryraadsheer)
    {
        $this->raadsheerRepository = $Repositoryraadsheer;
        $this->raadsheer = new Raadsheer();
    }

    public function index()
    {
        return $this->raadsheerRepository->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();
        $attributes['password'] = Hash::make(Str::random(8));

        $raadsheer = $this->raadsheerRepository->create($attributes);

        foreach (Formonderdeel::all() as $onderdeel) {
            if($request->input($onderdeel->onderdeel)){
                $raadsheer->formOnderdelen()->attach($onderdeel->id);
            }
        }

        return ['user' => $raadsheer, 'password' => $attributes['password']];
    }

    public function delete($id)
    {
        return $this->raadsheerRepository->delete($id);
    }

    public function read($id)
    {
        return $this->raadsheerRepository->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes['email'] = $request->input('email');
        $onderdelen = [];

        foreach (Formonderdeel::all() as $onderdeel) {
            if($request->input($onderdeel->onderdeel)){
                array_push($onderdelen, $onderdeel->id);
            }
        }

        $this->raadsheerRepository->updateFormonderdelen($id, $onderdelen);
        return $this->raadsheerRepository->update($id, $attributes);
    }

    public function newPassword($id)
    {
        $password = Str::random(8);

        $attributes = ['password' => Hash::make($password)];
        $this->raadsheerRepository->update($id, $attributes);

        return $password;
    }
}
