<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Formonderdeel;
use Gate;
use Illuminate\Http\Request;
use Auth;

class RaadsheerController extends Controller
{
    public function index()
    {
        return view('raadsheer.raadsheer')->with(['onderdelen' => Auth::user()->formOnderdelen()->get()]);
    }

    public function onderdeel(Formonderdeel $id)
    {
//        dd($formonderdeel);
        if (Gate::denies('raadsheer-onderdeel', $id)){
            return abort(403);
        }

        return view('raadsheer.onderdeel')->with(['onderdelen' => $id->vraag()->get(), 'formonderdeel' => $id]);
    }
}

//
// Einde code van Wouter
//
