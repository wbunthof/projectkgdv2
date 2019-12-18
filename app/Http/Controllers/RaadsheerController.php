<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Formonderdeel;
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
    return view('raadsheer.onderdeel')->with(['onderdelen' => $id->vraag->all()]);

    }
}

//
// Einde code van Wouter
//
