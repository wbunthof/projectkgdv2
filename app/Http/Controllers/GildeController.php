<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Gilde;

use App\Http\Controllers\inschrijfformulierController;

// formulieronderdelen
use App\Deelname;
use App\Gildemis;
use App\Optocht;
use App\Tentoonstelling;
use App\Geweer;
use App\Kruishandboog;
use App\Standaardrijden;
use App\Groep;
use App\Bazuinblazen;
use App\Trommen;
use App\Vendelen;
use App\Junioren;
use App\Deelnamemeerderewedstrijden;
use App\Vraag;
use App\Antwoord;

class GildeController extends Controller
{
  public function index()
  {
      $dataLeden = array();
      $dataVragen = array();
      $dataJunioren = array();
      $dataDeelnameMeedereWedstrijden = array();
      $vragen = array();
      $formonderdelenVragen = DB::table('vraag')->select('formonderdeel')->distinct()->get();
      // $antwoordenId = array();


      $modelsVragen = array(
        'deelname',
        'gildemis',
        'optocht',
        'tentoonstelling',
        'geweer',
        'kruis-handboog',
        'standaardrijden');
      $modelsLeden = array(
        'bazuinblazen',
        'trommen',
        'vendelen');
      $modelsAnders = array(
        'Junioren',
        'Deelnamemeerderewedstrijden');

      $vragen = Vraag::get();

      for ($i=0; $i < count($modelsVragen); $i++) {
        array_push($dataVragen,
                  array($modelsVragen[$i],
                        Antwoord::where('NBFS', Auth::user()->id)
                        ->whereHas('vraag',function ($query) use ($modelsVragen, $i) {
                            $query->where('formonderdeel', '=', str_replace('-', '', $modelsVragen[$i]));
                          })->get()));
//Antwoord::where('formonderdeel', $modelsVragen[$i])->get()));
      }

      $dataGroepen =  [];
      foreach ($modelsLeden as $model) {
        array_push($dataGroepen, [$model, Antwoord::where('NBFS', Auth::user()->id)
        ->whereHas('vraag',function ($query) use ($model) {
            $query->where('formonderdeel', '=', str_replace('-', '', $model));
          })->get()]);
      }




      // foreach ($modelsLeden as $model) {
      //   $dataVragen[$groepKey] = ['groep' => [$model => Antwoord::where('NBFS', Auth::user()->id)
      //   ->whereHas('vraag',function ($query) use ($model) {
      //       $query->where('formonderdeel', '=', str_replace('-', '', $model));
      //     })->get()]];
      // }
      // return dump($dataVragen);

      // Antwoord::with(['vraag' => function ($query) {
      //   $query->orderBy('id', 'desc');
      // }])->get();

      // return $tmp2;
      // foreach ($modelsVragen as $model) {
      //   $tmp = array();
      //   $tmp2 = array();
      //   $tmp3 = array();
      //   foreach ($tmp2 as $vraag) {
      //     // code...
      //   }
      //   array_push($tmp, $model, $tmp2);
      //   array_push($dataVragen, $tmp);
      // }

      foreach ($modelsLeden as $model) {
        $tmp = array();
        $classNaam = "App\\" . ucfirst($model);
        $class = New $classNaam();
        list($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie) = GildeController::GetKolommen($class->getTable());
        array_push($tmp, $model, $class::where('NBFS_id', Auth::user()->id)->get(), $KolommenDieKunnenVeranderen);
        array_push($dataLeden, $tmp);
      }

      $dataDeelnameMeedereWedstrijden = Deelnamemeerderewedstrijden::where('NBFS_id', Auth::user()->id)->get();

      $dataJunioren = Junioren::where('NBFS_id', Auth::user()->id)->get();

      $antwoorden = Antwoord::where('NBFS', Auth::user()->id)->get();
      $antwoordenId = array();
      foreach ($antwoorden as $antwoord) {
        array_push($antwoordenId, $antwoord->vraag_id);
      }


      return view('gilde.gilde')
                ->with('gilde', Auth::user())
                ->with('dataLeden', $dataLeden)
                ->with('dataDeelnameMeedereWedstrijden', $dataDeelnameMeedereWedstrijden)
                ->with('dataJunioren', $dataJunioren)
                ->with('dataVragen', $dataVragen)
                ->with('dataGroepen', $dataGroepen)
                ->with('vragen', $vragen)
                ->with('formonderdelenVragen', $formonderdelenVragen)
                ->with('antwoordenId', $antwoordenId)
                ->with('error', 'Test');

      // foreach ($tablesVerwijderenNBFS_id as $tabel) {
      //   $data[$tabel] = DB::table($tabel)->where('NBFS_id', Auth::user()->id)->get();
      // }
      // foreach ($models as $tabel) {
      //   $data[$tabel] = DB::table($tabel)->where('NBFS', Auth::user()->id)->get();
      // }
      // $data['vragen'] = DB::table('vraag')->get();
  }

  public function account()
  {
    return view('gilde.account');
  }

  public function accountUpdate(Request $request)
  {
    //update gebruikergegevens
    $user = Gilde::find($request->id);
    $tempOnderdeel = $request->onderdeel;
    $user->$tempOnderdeel = $request->waarde;
    $user->save();

    return redirect(route('gilde.account'))->with('success', 'Gegevens geüpdate');
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
}

// Extra functies voor taken die vaak uitgevoerd worden

//
// Einde code van Wouter
//
