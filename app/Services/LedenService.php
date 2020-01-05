<?php


namespace App\Services;


use App\Repositories\LedenRepository;
use Illuminate\Http\Request;


class LedenService
{

    protected $ledenService;

    public function __construct(LedenRepository $ledenRepository)
    {
        $this->ledenService = $ledenRepository;
    }

    public function index()
    {
        return $this->ledenService->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();

        $attributes['voorletter'] = $attributes['voornaam'][0];

        $attributes['formonderdeel_id'] = 1;

        return $this->ledenService->create($attributes);
    }

    public function read($id)
    {
        return $this->ledenService->find($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this->ledenService->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->ledenService->delete($id);
    }


}
