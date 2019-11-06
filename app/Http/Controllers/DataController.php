<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Gilde;
use App\Antwoord;
use App\Vraag;
use App\Bazuinblazen;
use App\Trommen;
use App\Vendelen;
use App\Formonderdeel;
use App\Discipline;
use App\Deelnamemeerderewedstrijden;
use App\Junioren;


class DataController extends Controller
{
    public function gilde($NBFS)
    {
      $vragenPerOnderdeel = array();
      foreach (Formonderdeel::all() as $onderdeel) {
        array_push($vragenPerOnderdeel, array($onderdeel->onderdeel, Antwoord::with(['vraag' => function ($query) use ($onderdeel) {
            $query->where('formonderdeel_id', $onderdeel->id);
            }])->where('NBFS', $NBFS)->get()));
      }

      // return dump($vragenPerOnderdeel);

      return  view('organiser.data.gilde')
                    ->with('gilde', Gilde::find($NBFS))
                    ->with('formonderdelen', Formonderdeel::all())
                    ->with('antwoorden', Antwoord::where('NBFS', $NBFS)->get())
                    ->with('vragen', Vraag::orderBy('formonderdeel_id')->get())
                    ->with('vragenPerOnderdeel', $vragenPerOnderdeel)
                    ->with('gilden', Gilde::all());
    }

    public function onderdeel($id)
    {
      return view('organiser.data.onderdeel')
                    ->with('formonderdelen', Formonderdeel::all())
                    ->with('gilden', Gilde::all())
                    ->with('onderdeel', Formonderdeel::find($id));
    }

    public function alleOnderdelen()
    {
      return view('organiser.data.alleOnderdelen')
                    ->with('formonderdelen', Formonderdeel::all())
                    ->with('gilden', Gilde::all())
                    ->with('onderdeel', Formonderdeel::find(1));
    }

    public function vraag($id)
    {
      return view('organiser.data.vraag')
                    ->with('formonderdelen', Formonderdeel::all())
                    ->with('gilden', Gilde::all())
                    ->with('vraag', Vraag::find($id));
    }

    public function leden($id)
    {
      if (!Discipline::find($id)) {
        return abort(404);
      }
      $discipline = Discipline::find($id);
      $tmp = 'App\\' . ucfirst($discipline->discipline);

      $tmp = new $tmp;
      $leden = $tmp::all();



      return view('organiser.data.leden')
                    ->with('gilden', Gilde::all())
                    ->with('leden', $leden)
                    ->with('kolommen', DataController::GetKolommen($discipline->discipline))
                    ->with('discipline', $discipline);
    }

    public function deelnameMeerdereWedstrijden()
    {
      return view('organiser.data.deelnameMeerdereWedstrijden')
                      ->with('gilden', Gilde::all())
                      ->with('leden', Deelnamemeerderewedstrijden::all());
    }

    public function zonderPas()
    {
      return view('organiser.data.zonderPas')
                      ->with('gilden', Gilde::all())
                      ->with('leden', Junioren::all());
    }



    private function GetKolommen($formonderdeel)
    {
      $koloms = DB::getSchemaBuilder()->getColumnListing($formonderdeel);
      $start = 0;
      $KolommenDieKunnenVeranderen = array();
      $KolommenDieKunnenVeranderenMetSpatie = array();
      foreach ($koloms as $kolom) {
        if ($kolom == 'geboortedatum') {
          $start = 1;
        } elseif ($kolom == 'created_at') {
          $start = 0;
        } elseif ($start == 1) {
          array_push($KolommenDieKunnenVeranderen, $kolom);
          array_push($KolommenDieKunnenVeranderenMetSpatie, ltrim(preg_replace('/(?<!\ )[A-Z]/', ' $0', $kolom)));
        }
      }
      return array($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie);
    }

    private function return(){

    }
}
