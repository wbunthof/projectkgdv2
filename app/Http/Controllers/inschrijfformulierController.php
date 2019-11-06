<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Leden;
use App\Vraag;
use App\Junioren;
use App\JuniorenDiscipline;
use App\Antwoord;
use App\Formonderdeel;
// use App\Deelname;
// use App\Gildemis;
// use App\Optocht;
// use App\Tentoonstelling;
// use App\Geweer;
// use App\Kruishandboog;
// use App\Standaardrijden;
// use App\Bazuinblazen;
// use App\Trommen;
// use App\Groep;


class inschrijfformulierController extends Controller
{
    // Normale formulier gedeelte met alleen vragen
    public function formShowNormal($formonderdeel)
    {
      // Als het $formonderdeel niet in de if zit geef 404 error weer
      if ($formonderdeel == 'deelname' || $formonderdeel == 'gildemis' || $formonderdeel == 'optocht' || $formonderdeel == 'tentoonstelling' || $formonderdeel == 'geweer' || $formonderdeel == 'kruis-handboog' || $formonderdeel == 'standaardrijden') {
        $formonderdeel = str_replace('-', '', $formonderdeel);
        // $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
        // $class = New $formonderdeelTotal();

        $vragen = Vraag::where('formonderdeel', $formonderdeel)->get();

        $vragenIds = array();

        foreach ($vragen as $vraag) {
          if(!is_null(Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first())) {
            $antwoorden[$vraag->id] = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first()->antwoord;
          }
          array_push($vragenIds, $vraag->id);
        }


        if ($formonderdeel == 'deelname'){
          if (!is_null(Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', 1 ]])->first())) {
            $antwoorden[1] = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', 1 ]])->first()->antwoord;
          }
        }

        if (empty($antwoorden)) {
          $antwoorden = array();
        }
        if (empty($vragen)) {
          $vragen = array();
        }

        $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
        $geheel = Vraag::count();

        return view('gilde.formulierNormal')
                  ->with('deel', $deel)
                  ->with('geheel', $geheel)
                  ->with('antwoorden', $antwoorden)
                  ->with('vragen', $vragen)
                  ->with('vragenIds', $vragenIds)
                  ->with('onderdeel', $formonderdeel)
                  ->with('urlVraagOpslaan', route('gilde.inschrijffomulier.vraagOpslaan', ['formonderdeel' => $formonderdeel]));
      } else {
        //geef 404 error omdat de pagina niet bestaat
        return abort(404);
      }
    }

    public function deelnameOpslaan(Request $request)
    {
      if (Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $request->vraag_id]])->count() == 0){
        $deelname = New Antwoord;
      } else {
        $deelname = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $request->vraag_id]])->first();
      }
      $deelname->vraag_id = $request->vraag_id;
      $deelname->NBFS = Auth::user()->id;
      $deelname->antwoord = $request->keuze;
      $deelname->save();
      return 'succes';

    }

    public function vraagOpslaan(Request $request, $formonderdeel)
    {
      // $formonderdeel = str_replace('-', '', $formonderdeel);
      // $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
      // $class = New $formonderdeelTotal();

      $vraag = Vraag::where('id', $request->vraag_id)->first();

      //Validatie
      // switch ($vraag->type) {
      //   case 'N':
      //     // $request = $request->validate([
      //     //   'waarde' => 'nummeric|nullable|between:' . $vraag->minimumValue . ',' . $vraag->maximumValue,
      //     // ]);
      //     break;
      //
      //   case 'B':
      //     // $request = $request->validate([
      //     //     'waarde' => 'boolean|nullable',
      //     //   ]);
      //     break;
      //
      //   case 'T':
      //   case 'TA':
      //     // $request = $request->validate([
      //     //   'waarde' => 'nullable|size:'. $vraag->maximumValue,
      //     // ]);
      //     break;
      //
      //   default:
      //     return 'Inputtype niet herkend';
      //     break;
      // }



      if (Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $request->vraag_id]])->count() == 0){
        // nee => nieuwe vraag;
        $vraag = New Antwoord;
        $vraag->vraag_id = $request->vraag_id;
        $vraag->NBFS = Auth::user()->id;
        $vraag->antwoord = $request->waarde;

      } else {
        // ja => oude vraag updaten
        $vraag = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $request->vraag_id]])->first();
        $vraag->antwoord = $request->waarde;
      }

      $vraag->save();

      return 'Opslaan vraag: '. $vraag->id .' gelukt';
    }

    // public function formOpslaan(Request $request, $formonderdeel)
    // {
    //   // Opslaan van deze data evt. omzetten naar AJAX
    //   $formonderdeel = str_replace('-', '', $formonderdeel);
    //   $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
    //   $class = New $formonderdeelTotal();
    //
    //   // alle vraagId's zijn verwerkt naar tekst omdat er geen array in een POST method verstuurd kan worden.
    //   $request->vraagIds = unserialize($request->vraagIds);
    //
    //   // $formAll wordt dadelijk een array met index => vraagId, en value => antwoord.
    //   $formAll = array();
    //
    //   for ($i = 0; $i < count($request->vraagIds); $i++) {
    //     $idTMP = $request->vraagIds[$i];
    //       $formAll[$i] = array('vraag_id' => $request->vraagIds[$i], 'antwoord' => $request->$idTMP);
    //   }
    //
    //   // Elke vraag behandelen
    //   foreach ($formAll as $form) {
    //
    //     // Kijk of er al een antwoord is opgeslagen in de database
    //     if ($class::where([['NBFS', Auth::user()->id],['vraag_id', $form['vraag_id']]])->count() == 0){
    //       // nee => nieuwe vraag;
    //       $vraag = New $class;
    //       $vraag->vraag_id = $form['vraag_id'];
    //       $vraag->NBFS = Auth::user()->id;
    //       $vraag->antwoord = $form['antwoord'];
    //
    //     } else {
    //       // ja => oude vraag updaten
    //       $vraag = $class::where([['NBFS', Auth::user()->id],['vraag_id', $form['vraag_id']]])->first();
    //       $vraag->antwoord = $form['antwoord'];
    //     }
    //
    //     $vraag->save();
    //   }
    //
    //   // Redirect terug naar vorige pagina
    //   return back()->with('succes', 'Gegevens opgeslagen');
    // }

    // Formulier gedeelte waar er leden worden toegevoegd
    public function formShowTable($formonderdeel)
    {
      if ($formonderdeel == 'bazuinblazen' || $formonderdeel == 'trommen' || $formonderdeel == 'vendelen' || $formonderdeel == 'deelname-meerdere-wedstrijden') {
        $formonderdeel = str_replace('-', '', $formonderdeel);
        $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
        $class = New $formonderdeelTotal();

        // Leden
        $leden = $class::where('NBFS_id', Auth::user()->id)->get();
        $emptyLeden = (empty($leden{0})) ? true : false;

        list($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie) = inschrijfformulierController::GetKolommen($formonderdeel);

        // Vragen
        $vragen = Vraag::where('formonderdeel', $formonderdeel)->get();

        $vragenIds = [];
        foreach ($vragen as $vraag) {
          if(!is_null(Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first())) {
            $antwoorden[$vraag->id] = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first()->antwoord;
          }
          array_push($vragenIds, $vraag->id);
        }

        if (empty($antwoorden)) {
          $antwoorden = array();
        }
        if (empty($vragen)) {
          $vragen = array();
        }

        $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
        $geheel = Vraag::count();

        // return dd($junioren);
        return view('gilde.formulierTable')
        ->with('onderdeel', $formonderdeel)
        ->with('leden', $leden)
        ->with('koloms', $koloms)
        ->with('KolommenDieKunnenVeranderen', $KolommenDieKunnenVeranderen)
        ->with('KolommenDieKunnenVeranderenMetSpatie', $KolommenDieKunnenVeranderenMetSpatie)
        ->with('emptyLeden', $emptyLeden)
        ->with('antwoorden', $antwoorden)
        ->with('vragen', $vragen)
        ->with('vragenIds', $vragenIds)
        ->with('deel', $deel)
        ->with('geheel', $geheel)
        ->with('urlVraagOpslaan', route('gilde.inschrijffomulier.vraagOpslaan', ['formonderdeel' => 'groep']));
      } else {
        //geef 404 error omdat de pagina niet bestaat
        return abort(404);
      }
    }

    public function lidToevoegen(Request $request, $formonderdeel)
    {
      if (empty($request->onderdeel) || empty($request->nummer) || empty($request->discipline)) {
        return back()->with('error', 'Vul alles in');
      }

      $discipline = DB::table('discipline')->where('discipline', $formonderdeel)->first();

      $formonderdeel = str_replace('-', '', $formonderdeel);
      $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
      $class = New $formonderdeelTotal();

      list($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie) = inschrijfformulierController::GetKolommen($formonderdeel);

      if (Leden::where([['leden_id', $request->nummer],['discipline_id', inschrijfformulierController::disciplineId($request->onderdeel)]])->get()->count() == 0) {
        return back()->with('error', 'Lid bestaat niet');
      }

      if ($class::where([['leden_id', $request->nummer + ($discipline->id * 100000)],['NBFS_id', Auth::user()->id]])->get()->count() > 0) {

        return back()->with('error', 'Lid al toegevoegd');
      }

      $class = New $class;
      $class->leden_id = Leden::where([['leden_id', $request->nummer],['discipline_id', inschrijfformulierController::disciplineId($request->onderdeel)]])->first()->id;//$request->nummer;
      $class->NBFS_id = Auth::user()->id;

      foreach ($KolommenDieKunnenVeranderen as $kolomVeranderd1) {
        $class->$kolomVeranderd1 = 0;
      }
      $discipline = $request->discipline;//str_replace(' ', '', $request->discipline);
      if (!array_search($discipline, DB::getSchemaBuilder()->getColumnListing($formonderdeel))) {
        return back()->with('error', 'Discipline niet gevonden. Mail: info@pure-air.nl');
      }
      $class->$discipline = 1;
      $class->save();

      return back()->with('succes', 'Gegevens opgeslagen');
    }

    public function lidVerwijderen(Request $request, $formonderdeel)
    {
      $formonderdeel = str_replace('-', '', $formonderdeel);
      $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
      $class = New $formonderdeelTotal();

      if ($class::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->count() == 0){
        return back()->with('error', 'Lid bestaat niet, of is niet toegevoegd');
      } else {
        $deelname = $class::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->first();
        $class::destroy($deelname->id);
        return back()->with('succes', 'Lid verwijderd');
      }
    }

    public function lidUpdaten(Request $request, $formonderdeel)
    {
      $formonderdeel = str_replace('-', '', $formonderdeel);
      $formonderdeelTotal = "App\\".ucfirst($formonderdeel);
      $class = New $formonderdeelTotal();

      list($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie) = inschrijfformulierController::GetKolommen($formonderdeel);

      if ($class::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->count() == 0){
        return back()->withInput(Input::all())->with('error', 'Lid bestaat niet, of is niet toegevoegd');
      } else {
        $lid = $class::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->first();

        foreach ($KolommenDieKunnenVeranderen as $kolom) {
          $lid->$kolom = 0;
        }
        $discipline = $request->discipline;
        $lid->$discipline = 1;
        $lid->save();
        return 'succes';
      }
    }
    // Fromulier ondrdeerl met gewone vragen voor bij leden gedeelte
    public function vraagOpslaanTable(Request $request, $formonderdeel)
    {
      $vraag = Vraag::where('id', $request->vraag_id)->first();

      if (Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $request->vraag_id]])->count() == 0){
        // nee => nieuwe vraag;
        $vraag = New Antwoord;
        $vraag->vraag_id = $request->vraag_id;
        $vraag->NBFS = Auth::user()->id;
        $vraag->antwoord = $request->waarde;

      } else {
        // ja => oude vraag updaten
        $vraag = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $request->vraag_id]])->first();
        $vraag->antwoord = $request->waarde;
      }

      $vraag->save();

      return 'Opslaan vraag: '. $vraag->id .' gelukt';
    }

    // Formulier onderdeel voor junioren
    public function juniorenShow()
    {
      // Junioren
      $junioren = Junioren::where('NBFS_id', Auth::user()->id)->get();
      $emptyJunioren = (empty($junioren{0})) ? true : false;

      $klasse = JuniorenDiscipline::all();

      $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
      $geheel = Vraag::count();

      // return dump($klasse{1}->Junioren{0}->voornaam);
      return view('gilde.formulierJunioren')
              ->with('deel', $deel)
              ->with('geheel', $geheel)
              ->with('junioren', $junioren)
              ->with('emptyJunioren', $emptyJunioren)
              ->with('klasse', $klasse)
              ->with('onderdeel', 'Junioren');
    }

    public function juniorToevoegen(Request $request)
    {
      if (empty($request->klasse) || empty($request->voornaam) || empty($request->achternaam) || empty($request->geboortedatum)) {
        return back()->with('error', 'Vul alles in');
      }

      // if (!(preg_match('/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/', $request->geboortedatum) || preg_match('/^\s*(3[01]|[12][0-9]|0?[1-9])\-(1[012]|0?[1-9])\-((?:19|20)\d{2})\s*$/', $request->geboortedatum))) {
      //   // code...
      // }

      $class = New Junioren;
      $class->voornaam = $request->voornaam;
      $class->achternaam = $request->achternaam;
      $class->geboortedatum = $request->geboortedatum;
      $class->NBFS_id = Auth::user()->id;
      $class->juniorenDiscipline_id = $request->klasse;

      $class->save();

      return back()->with('succes', 'Gegevens opgeslagen');
    }

    public function juniorVerwijderen(Request $request, $formonderdeel)
    {
      if (Junioren::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->count() == 0){
        return back()->with('error', 'Lid bestaat niet, of is niet toegevoegd');
      } else {
        $deelname = Junioren::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->first();
        Junioren::destroy($deelname->id);
        return back()->with('succes', 'Lid verwijderd');
      }
    }

    // Formulier onderdeel deelname meerdere wedstrijden
    public function formDeelnameMeerdereWedstrijden()
    {
      $class = New \App\Deelnamemeerderewedstrijden();

      $leden = $class::where('NBFS_id', Auth::user()->id)->get();
      //return ($class)->first();

      list($koloms, $KolommenDieKunnenVeranderen, $KolommenDieKunnenVeranderenMetSpatie) = inschrijfformulierController::GetKolommen('DeelnameMeerdereWedstrijden');


      if (empty($leden{0})) {
        $empty = true;
      } else {
        $empty = false;
      }

      $formonderdeel = 'Deelname meerdere wedstrijden';

      $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
      $geheel = Vraag::count();

      //return dd($leden);
      return view('gilde.deelnameMeerdereWedstrijden')
                  ->with('onderdeel', $formonderdeel)
                  ->with('leden', $leden)->with('koloms', $koloms)
                  ->with('KolommenDieKunnenVeranderen', $KolommenDieKunnenVeranderen)
                  ->with('KolommenDieKunnenVeranderenMetSpatie', $KolommenDieKunnenVeranderenMetSpatie)
                  ->with('empty', $empty)
                  ->with('deel', $deel)
                  ->with('geheel', $geheel);
    }

    public function formDeelnameMeerdereWedstrijdenToevoegen(Request $request)
    {
      if (empty($request->Naam) || empty($request->Disciplines)) {
        return back()->withInput(Input::all())->with('error', 'Vul alle gegevens in');

      }


      $class = New \App\Deelnamemeerderewedstrijden();

      $class = New $class;
      $class->naam = $request->Naam;
      $class->disciplines = $request->Disciplines;
      $class->NBFS_id = Auth::user()->id;

      $class->save();

      return back()->with('succes', 'Gegevens opgeslagen');
    }

    public function formDeelnameMeerdereWedstrijdenVerwijderen(Request $request)
    {
      $class = New \App\Deelnamemeerderewedstrijden();

      if ($class::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->count() == 0){
        return back()->with('error', 'Lid bestaat niet, of is niet toegevoegd');
      } else {
        $deelname = $class::where([['NBFS_id', Auth::user()->id],['id', $request->id]])->first();
        $class::destroy($deelname->id);
        return back()->with('succes', 'Lid verwijderd');
      }
    }

    // Extra functies voor taken die vaak uitgevoerd worden
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

    private function disciplineId($discipline)
    {
      switch ($discipline) {
        case 'bazuinblazen':
          return 0;
          break;

        case 'trommen':
          return 1;
          break;

        case 'vendelen':
          return 2;
          break;

        default:
          return abort(404);
          break;
      }
    }
  }

//
// Einde code van Wouter
//
