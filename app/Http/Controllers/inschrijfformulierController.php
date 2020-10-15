<?php
//
// Begin code van Wouter
//
namespace App\Http\Controllers;

use App\Formonderdelendiscipline;
use App\Services\AnswerService;
use App\Services\LedenService;
use App\Services\QuestionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Leden;
use App\Vraag;
use App\Junioren;
use App\Antwoord;
use App\Formonderdeel;


class  inschrijfformulierController extends Controller
{
    protected $vraagService;
    protected $antwoordService;
    protected $ledenService;

    public function __construct(QuestionService $questionService, AnswerService $answerService, LedenService $ledenService)
    {
        $this->vraagService = $questionService;
        $this->antwoordService = $answerService;
        $this->ledenService = $ledenService;
    }

    public function index(Formonderdeel $formonderdeel)
    {
        $return = [];

        if ($formonderdeel->leden)
        {
            return $this->formShowTable($formonderdeel);
        }

        if ($formonderdeel->meerderewedstrijden)
        {
            return $this->formDeelnameMeerdereWedstrijden();
        }

        if ($formonderdeel->junioren)
        {
            return $this->juniorenShow();
        }

        if ($formonderdeel->vragen)
        {
            return $this->formShowNormal($formonderdeel);

            $return['deel'] =  Auth::user()->antwoorden->count();
            $return['geheel'] = Vraag::count();
            $return['vorige'] = Formonderdeel::where('id', '<', Formonderdeel::find(10)->id)->max('id');
            $return['volgende'] = Formonderdeel::where('id', '>', Formonderdeel::find(10)->id)->min('id');

            return view('gilde.formulierNormal')
                ->with('antwoorden', $antwoorden)
                ->with('vragen', $vragen)
                ->with('vragenIds', $vragenIds)
                ->with('onderdeel', $formonderdeel->onderdeel)
                ->with('urlVraagOpslaan', route('gilde.inschrijffomulier.vraagOpslaan'));
        }

        return abort(404);
    }

    // Normale formulier gedeelte met alleen vragen
    public function formShowNormal(Formonderdeel $formonderdeel)
    {
        // Als het $formonderdeel niet in de if zit geef 404 error weer
        if (!$formonderdeel->vragen) {
            abort(404);
        }

        $vragenIds = array();
        $antwoorden = array();

        $vragen = $formonderdeel->vraag;

        foreach ($vragen as $vraag) {
            if(!is_null(Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first())) {
                $antwoorden[$vraag->id] = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first()->antwoord;
            }
            array_push($vragenIds, $vraag->id);
        }


        if ($formonderdeel->id == 1){
            if (!is_null(Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', 1 ]])->first())) {
                $antwoorden[1] = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', 1 ]])->first()->antwoord;
            }
        }

        $deel= Auth::user()->antwoorden->count();
        $geheel = Vraag::count();
        $vorige = Formonderdeel::where('id', '<', $formonderdeel->id)->where('id', '!=', 0)->max('id');
        $volgende = Formonderdeel::where('id', '>', $formonderdeel->id)->where('id', '!=', 0)->min('id');

        return view('gilde.formulierNormal')
            ->with('volgende', $volgende)
            ->with('vorige', $vorige)
            ->with('deel', $deel)
            ->with('geheel', $geheel)
            ->with('antwoorden', $antwoorden)
            ->with('vragen', $vragen)
            ->with('vragenIds', $vragenIds)
            ->with('onderdeel', $formonderdeel->onderdeel)
            ->with('urlVraagOpslaan', route('gilde.inschrijffomulier.vraagOpslaan'));
    }

    public function vraagOpslaan(Request $request)
    {
       $validate = $request->validate([
           'vraag_id' => 'required|integer|exists:vraag,id',
           'waarde' => 'required'
       ]);

        $antwoord = Antwoord::where([])->updateOrCreate([
            // Create or update a record matching the attributes
            'NBFS' => Auth::user()->id,
            'vraag_id' => $request->vraag_id
        ],[
            // Fill it with values.
            'NBFS'=> Auth::user()->id,
            'vraag_id' => $request->vraag_id,
            'antwoord' => $request->waarde
        ]);

        return 'Opslaan vraag: ' . $antwoord->vraag->id . ' gelukt';
    }

    // Formulier gedeelte waar er leden worden toegevoegd
    public function formShowTable(Formonderdeel $formonderdeel)
    {

        if (!$formonderdeel->leden) {
            return abort(404);
        }
            $antwoorden = array();
            $vragen = $formonderdeel->vraag;
            $vragenIds = [];

            foreach ($vragen as $vraag) {
                if(!is_null(Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first())) {
                    $antwoorden[$vraag->id] = Antwoord::where([['NBFS', Auth::user()->id],['vraag_id', $vraag->id ]])->first()->antwoord;
                }
                array_push($vragenIds, $vraag->id);
            }

            $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
            $geheel = Vraag::count();
            $vorige = Formonderdeel::where('id', '<', $formonderdeel->id)->where('id', '!=', 0)->max('id');
            $volgende = Formonderdeel::where('id', '>', $formonderdeel->id)->where('id', '!=', 0)->min('id');


            return view('gilde.formulierTable')
                ->with('leden', Auth::user()->leden()->where('formonderdeel_id', $formonderdeel->id)->get())
                ->with('disciplines', $formonderdeel->formonderdelendiscipline()->with('leden')->get())
                ->with('onderdeel', $formonderdeel->onderdeel)
                ->with('formonderdeel', $formonderdeel)
                ->with('antwoorden', $antwoorden)
                ->with('vragen', $vragen)
                ->with('vragenIds', $vragenIds)
                ->with('volgende', $volgende)
                ->with('vorige', $vorige)
                ->with('deel', $deel)
                ->with('geheel', $geheel)
                ->with('urlVraagOpslaan', route('gilde.inschrijffomulier.vraagOpslaan'));
    }

    public function lidToevoegen(Request $request)
    {

        $request->request->add(['gilde_id' => Auth::id()]);
        $request->validate([
            'leden_id' => 'required|integer|exists:leden',
            'onderdeel' => 'required|integer|exists:formonderdelen,id',
            'formonderdelendiscipline_id' => 'required|integer|exists:formonderdelendisciplines,id',
            'gilde_id' => 'required|integer|exists:gilde,id'
        ]);

        $lid = Leden::where([['leden_id', $request->leden_id],['formonderdeel_id', $request->onderdeel]])->firstOrFail();

        if (Gate::denies('lid-vrij',$lid)) {
            return redirect()->back()->with('error', 'Dit lid is al toegevoegd door een gilde');
        }


        try {
            $this->ledenService->update($request, $lid->id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return back()->with('succes', 'Gegevens opgeslagen');
    }

    public function lidVerwijderen(Request $request, int $id)
    {

        $request->request->add([
            'gilde_id' => null,
            'formonderdelendiscipline_id' => null
        ]);

        try {
            $lid = $this->ledenService->update($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return back()->with('succes', 'Lid verwijderd');
    }
    public function lidUpdaten(Request $request, Leden $id)
    {
        $request->validate([
            'id' => 'required|integer|exists:leden',
            'formonderdelendiscipline_id' => 'required|integer|exists:formonderdelendisciplines,id',
        ]);


        if (Gate::denies('gilde-update-leden', $id))
        {
            return abort(401);
        }

        try {
            $lid = $this->ledenService->update($request, $request->id);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return 'succes';
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
        $emptyJunioren = empty($junioren->first());

        $klasse = Formonderdelendiscipline::all();

        $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
        $geheel = Vraag::count();
        $vorige = Formonderdeel::where('id', '<', Formonderdeel::where('onderdeel', 'junioren & leden zonder pas')->first()->id)->where('id', '!=', 0)->max('id');
        $volgende = Formonderdeel::where('id', '>', Formonderdeel::where('onderdeel', 'junioren & leden zonder pas')->first()->id)->where('id', '!=', 0)->min('id');


        // return dump($klasse{1}->Junioren{0}->voornaam);
        return view('gilde.formulierJunioren')
            ->with('deel', $deel)
            ->with('geheel', $geheel)
            ->with('vorige', $vorige)
            ->with('volgende', $volgende)
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


        if (empty($leden->first())) {
            $empty = true;
        } else {
            $empty = false;
        }

        $formonderdeel = Formonderdeel::where('onderdeel', 'Deelname meerdere wedstrijden')->first();

        $deel = Antwoord::where('NBFS', Auth::user()->id)->count();
        $geheel = Vraag::count();
        $vorige = Formonderdeel::where('id', '<', $formonderdeel->id)->where('id', '!=', 0)->max('id');
        $volgende = Formonderdeel::where('id', '>', $formonderdeel->id)->where('id', '!=', 0)->min('id');


        //return dd($leden);
        return view('gilde.deelnameMeerdereWedstrijden')
                ->with('onderdeel', $formonderdeel->onderdeel)
                ->with('leden', $leden)->with('koloms', $koloms)
                ->with('KolommenDieKunnenVeranderen', $KolommenDieKunnenVeranderen)
                ->with('KolommenDieKunnenVeranderenMetSpatie', $KolommenDieKunnenVeranderenMetSpatie)
                ->with('empty', $empty)
                ->with('deel', $deel)
                ->with('geheel', $geheel)
                ->with('vorige', $vorige)
                ->with('volgende', $volgende);
    }

    public function formDeelnameMeerdereWedstrijdenToevoegen(Request $request)
    {

        $request->validate([
            'Naam' => 'required|string',
            'Disciplines' => 'required|string'
        ]);

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
