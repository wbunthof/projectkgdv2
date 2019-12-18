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

    protected $raadsheerService;
    protected $raadsheer;

    public function __construct(RaadsheerRepository $raadsheerService)
    {
        $this->raadsheerService = $raadsheerService;
        $this->raadsheer = new Raadsheer();
    }

    public function index()
    {
        return $this->raadsheerService->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();
        $attributes['password'] = Hash::make(Str::random(8));

        $raadsheer = $this->raadsheerService->create($attributes);

        foreach (Formonderdeel::all() as $onderdeel) {
            if($request->input($onderdeel, 0)){
                $this->raadsheerService->formOnderdelen()->attach(Formonderdeel::where('onderdeel', $onderdeel)->first(), $raadsheer->id);
            }
        }
        dump($request->all());
        dump($attributes);
        dump($raadsheer);

    }

    public function delete($id)
    {
        $this->raadsheerService->delete($id);
    }

    public function read($id)
    {
        return $this->raadsheerService->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->raadsheerService->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->raadsheerService->delete($id);
    }
}
