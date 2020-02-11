<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Leden;
use Illuminate\Http\Request;
use App\Gilde;
use App\Antwoord;
use App\Vraag;
use App\Bazuinblazen;
use App\Trommen;
use App\Vendelen;
use App\Formonderdeel;
use App\Junioren;
use App\Deelnamemeerderewedstrijden;

class OrganiserController extends Controller
{
  public function index()
  {
      return view('organiser.organiser')
              ->with('leden', array(    'bazuinblazen' => Leden::whereFormonderdeelId('6')->get(),
                                        'trommen' => Leden::whereFormonderdeelId('10')->get(),
                                        'vendelen' => Leden::whereFormonderdeelId('11')->get(),
                                        'junioren' => Junioren::all(),
                                        'deelnameMeerdereWedstrijden' => Deelnamemeerderewedstrijden::all()))
              ->with('antwoorden', Antwoord::all())
              ->with('vragen', Vraag::all())
              ->with('formonderdelen', Formonderdeel::orderBy('onderdeel')->get())
              ->with('test', Formonderdeel::with('vraag.antwoord')->get())
              ->with('gilden', Gilde::orderBy('id')->where('id', '>', '100')->get());
  }

  public function account()
  {
    return view('organiser.account');
  }
}

//
// Einde code van Wouter
//
