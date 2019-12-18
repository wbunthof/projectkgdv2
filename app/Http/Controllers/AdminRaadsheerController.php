<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use App\Services\RaadsheerService;
use Illuminate\Http\Request;
use Hash;
use Str;

class AdminRaadsheerController extends Controller
{
    protected $raadsheerservice;

    public function __construct(RaadsheerService $raadsheerService)
    {
        $this->raadsheerservice = $raadsheerService;
    }

    public function index()
    {
        return view('admin.raadsheer')->with(['raadsheren' => $this->raadsheerservice->index(), 'onderdelen' => Formonderdeel::all()]);
//        return $this->raadsheerservice->index();
    }

    public function create(Request $request)
    {
        return $this->raadsheerservice->create($request);
//        return dd($request->all());
    }
}
