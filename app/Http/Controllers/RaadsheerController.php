<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Deelnamemeerderewedstrijden;
use App\Formonderdeel;
use App\Junioren;
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
        if (Gate::denies('raadsheer-onderdeel', $id)){
            return abort(403);
        }

        return view('raadsheer.onderdeel')->with([
            'onderdelen' => $id->vraag()->get(),
            'formonderdeel' => $id,
//            'leden' => $id->leden()->get(),
            'deletedVragen' => $id->vraag()->onlyTrashed()->get()]);
    }


}

//
// Einde code van Wouter
//
