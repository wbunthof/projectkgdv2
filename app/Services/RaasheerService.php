<?php


namespace App\Services;


use App\Repositories\RaadsheerRepository;
use Illuminate\Http\Request;


class RaasheerService
{

    protected $raadsheerService;

    public function __construct(RaadsheerRepository $raadsheerService)
    {
        $this->raadsheerService = $raadsheerService;
    }

    public function index()
    {
        return $this->raadsheerService->all();
    }

    public function create(Request $request)
    {

        $attributes = $request->all();
        return $this->raadsheerService->create($attributes);
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
