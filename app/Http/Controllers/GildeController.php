<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Raadsheer;
use App\Services\GildeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Gilde;

// formulieronderdelen
use App\Formonderdeel;
use App\Junioren;
use App\Deelnamemeerderewedstrijden;
use App\Vraag;
use App\Antwoord;

class GildeController extends Controller
{
    protected $gildeservice;

    public function __construct(GildeService $gildeservice)
    {
        $this->gildeservice = $gildeservice;
    }
    public function account()
    {
    return view('gilde.account');
    }
    public function accountUpdate(Request $request)
    {
        try {
            $this->gildeservice->update($request, Auth::id());
        } catch (Exception $e) {
            return back()->with('error' , 'Niet opgeslagen, probeer opnieuw!, Error: ' .  $e->getMessage());
        }

        return redirect(route('gilde.account'))->with('succes', 'Gegevens geüpdate');
    }


//   TODO: Updaten naar repository/service pattern
    public function index()
    {
        $dataLeden = array();
        $dataVragen = array();
        $dataJunioren = array();
        $dataDeelnameMeedereWedstrijden = array();
        $vragen = array();
        $formonderdelenVragen = Formonderdeel::all('onderdeel');

        // $antwoordenId = array();


        $modelsLeden = Formonderdeel::where('leden', 1)->get();
        $modelsAnders = Formonderdeel::where([['leden', 0],['vragen',0]])->get();

        $vragen = Vraag::get();

//        $id = 1;
//        dd(Auth::user()->antwoorden()->whereHas('vraag',function ($query) use ($id) {
//                $query->where('formonderdeel_id', $id);
//                            })->get());

//        for ($i=0; $i < count($modelsVragen); $i++) {

        $dataGroepen =  [];
        foreach ($modelsLeden as $model) {
            array_push($dataGroepen, [$model->onderdeel,
                Auth::user()->antwoorden()->whereHas('vraag', function ($query) use ($model) {
                    $query->where('formonderdeel_id', $model->id);
                })->get()]);
//                Antwoord::where('NBFS', Auth::user()->id)
//                                                      ->whereHas('vraag',function ($query) use ($model) {
//                                                          $query->where('formonderdeel', '=', str_replace('-', '', $model));
//                                                      })->get()]);
        }






        foreach ($modelsLeden as $model) {
//            $tmp = array();
//            $classNaam = "App\\" . ucfirst($model);
//            $class = New $classNaam();
//            list($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie) = GildeController::GetKolommen($class->getTable());
//            array_push($tmp, $model, $class::where('NBFS_id', Auth::user()->id)->get(), $KolommenDieKunnenVeranderen);
//            array_push($dataLeden, $tmp);
        }

        $antwoorden = Antwoord::where('NBFS', Auth::user()->id)->get();
        $antwoordenId = array();
        foreach ($antwoorden as $antwoord) {
            array_push($antwoordenId, $antwoord->vraag_id);
        }

        return view('gilde.gilde')
            ->with('gilde', Auth::user())
            ->with('onderdelen', Formonderdeel::all())
            ->with('dataLeden', $dataLeden)
            ->with('deelnameMeerdereWedstrijden', Deelnamemeerderewedstrijden::where('NBFS_id', Auth::user()->id)->get())
            ->with('junioren', Junioren::with('discipline')->where('NBFS_id', Auth::user()->id)->get())
            ->with('onderdelenVragen', Formonderdeel::where([['leden', 0],['vragen',1]])->get())
            ->with('onderdelenLeden', Formonderdeel::where('leden', 1)->get())
            ->with('vragen', $vragen)
            ->with('formonderdelenVragen', $formonderdelenVragen)
            ->with('antwoordenId', $antwoordenId)
            ->with('error', 'Test');

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

        // foreach ($tablesVerwijderenNBFS_id as $tabel) {
        //   $data[$tabel] = DB::table($tabel)->where('NBFS_id', Auth::user()->id)->get();
        // }
        // foreach ($models as $tabel) {
        //   $data[$tabel] = DB::table($tabel)->where('NBFS', Auth::user()->id)->get();
        // }
        // $data['vragen'] = DB::table('vraag')->get();
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
//
// Einde code van Wouter
//
