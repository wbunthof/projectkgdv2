<?php

namespace App\Http\Controllers;

use App\Antwoord;
use App\Bazuinblazen;
use App\Formonderdeel;
use App\Formonderdelendiscipline;
use App\Leden;
use App\Trommen;
use App\Vendelen;
use App\Vraag;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Exception;
use Gate;
use Illuminate\Http\Request;

class RaadsheerVraagController extends Controller
{
    protected $vraagService;
    protected $antwoordService;

    public function __construct(QuestionService $questionService, AnswerService $answerService)
    {
        $this->vraagService = $questionService;
        $this->antwoordService = $answerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dump($tmp = Formonderdelendiscipline::with('leden', 'leden.gilde')->find(8));


//        foreach (Vendelen::all() as $vendel)
////        {
////            $id = $vendel->leden_id - 200000;
////            $lid = Leden::where([['leden_id', '=', $id], ['formonderdeel_id', '=', 11]])->first();
////            $disciplineid = array_search(1, [13 => $vendel->{"senioren C"},
////                14 => $vendel->{"senioren C+"},
////                15 => $vendel->{"senioren Acrobatiek"},
////                16 => $vendel->{"senioren Zonder Acrobatiek 35 t/m 50 jaar"},
////                17 => $vendel->{"senioren Zonder Acrobatiek 51+ jaar"},
////                3 => $vendel->{"Junioren"}]);
////
////            $lid->gilde_id = $vendel->NBFS_id;
////            $lid->formonderdelendiscipline_id = $disciplineid;
////
////            $lid->save();
////        }
///
//        foreach (Trommen::orderBy('leden_id')->get() as $trom)
//        {
//            $disciplineid = array_search(1,
//                [8 => $trom->{"senioren U"},
//                    9 => $trom->{"senioren A"},
//                    10 => $trom->{"senioren B"},
//                    11 => $trom->{"senioren C"},
//                    12 => $trom->{"senioren E"},
//                    1 => $trom->{"Junioren muziektrom"},
//                    2 => $trom->{"Junioren gildetrom"}]);
//
//            dump([8 => $trom->{"senioren U"},
//                9 => $trom->{"senioren A"},
//                10 => $trom->{"senioren B"},
//                11 => $trom->{"senioren C"},
//                12 => $trom->{"senioren E"},
//                1 => $trom->{"Junioren muziektrom"},
//                2 => $trom->{"Junioren gildetrom"}]);
//
//            $id = $trom->leden_id - 100000;
//            $lid = Leden::select(['formonderdeel_id', 'id', 'idOld', 'voornaam', 'achternaam', 'formonderdelendiscipline_id', 'gilde_id'])->where([['leden_id', '=', $id], ['formonderdeel_id', '=', 10]])->first();
//
//            $lid->gilde_id = $trom->NBFS_id;
//            $lid->formonderdelendiscipline_id = $disciplineid;
//            dump($lid);
//            $lid->save();
////            1 raar record met id 200073 -> frank hilt
//        }

//        foreach (Bazuinblazen::orderBy('leden_id')->get() as $bazuin)
//        {
//            $disciplineid = array_search(1,
//                [   5 => $bazuin->{"senioren A"},
//                    6 => $bazuin->{"senioren B"},
//                    7 => $bazuin->{"senioren C"},
//                    4 => $bazuin->{"Junioren"}]);
//
//            dump($bazuin);
//
////            dump([   5 => $bazuin->{"senioren A"},
////                6 => $bazuin->{"senioren B"},
////                7 => $bazuin->{"senioren C"},
////                4 => $bazuin->{"Junioren"}]);
//
//            $id = $bazuin->leden_id;
//            $lid = Leden::where([['leden_id', '=', $id], ['formonderdeel_id', '=', 6]])->first();
//
//            $lid->gilde_id = $bazuin->NBFS_id;
//            $lid->formonderdelendiscipline_id = $disciplineid;
//
//            $lid->save();
//            dump($lid);
//        }

//        $lid = new Leden();
//        $lid->formonderdeel_id = 4;
//        $lid->id = 2001;
//        $lid->idOld = 200;
//        $lid->leden_id = 200;
//        $lid->voorletter = 200;
//        $lid->voornaam = 200;
//        $lid->achternaam = 200;
//        $lid->geboortedatum = Carbon::today();
//        $lid->setIdAttribute($lid->id);
//        dump($lid->getAttributes('id'));
//        dump(Leden::findOrFail(2001)->id);
//        $leden->save();
//        dump(Leden::find(600236)->discipline()->get());
//        , Leden::find(600241), Leden::find(600276)));
//        dump(Formonderdelendiscipline::first()->leden()->get());

//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
//
//        foreach (Leden::all() as $lid){
//            $lid->gilde_id = null;
//            $lid->save();
//
//        }
//
//        DB::statement('SET FOREIGN_KEY_CHECKS=1');
//        Leden::first()->discipline()->detach();

//        dd(Formonderdelendiscipline::first()->leden()->get());

//        foreach (Formonderdelendiscipline::get() as $item) {
//            Trommen::where()
//            dd($item->leden()->get());
//        }

//        $formonderdelen = Formonderdeel::findMany([6,10,11]);
//
//        foreach ($formonderdelen as $formonderdeel){
//            $formonderdeel->leden = 1;
//            $formonderdeel->save();
//        }

//        $formonderdelen = Formonderdeel::findMany([1,2,3,4,6,7,8,9,10,11]);
//
//        foreach ($formonderdelen as $formonderdeel){
//            $formonderdeel->vragen = 1;
//            $formonderdeel->save();
//        }

//        $vragen = Vraag::all();
//
//        foreach ($vragen as $vraag){
//            $vraag->type = $vraag->type;
//            $vraag->save();
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request)
    {
        if (Gate::denies('raadsheer-onderdeel', Formonderdeel::findOrFail($request->formonderdeel_id))){
            abort(403);
        }

        $vaildation = $request->validate([
            'formonderdeel_id' => 'required|integer|exists:formonderdelen,id',
            'tekst' => 'required|string',
            'extraInfo' => 'string|nullable',
            'type' => 'required|string',
            'minimumValue' => 'integer|nullable',
            'maximumValue' => 'integer|nullable',
            'placeholder' => 'string|nullable'
        ]);

//        dd($request->all());

        try {
            $this->vraagService->create($request);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol!']);

    }

//    /**9
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showData($id)
    {
        if (Gate::denies('raadsheer-onderdeel', Vraag::findOrFail($id)->formOnderdeel)){
            abort(403);
        }

        return redirect()->back()->with('error', 'Moet nog gemaakt worden');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        if (Gate::denies('raadsheer-onderdeel', Vraag::findOrFail($id)->formOnderdeel)){
            abort(403);
        }

        $vaildation = $request->validate([
            'tekst' . $id => 'required|string',
            'extrainfo' . $id => 'string|nullable',
            'type' . $id => 'required|string',
            'minimumValue' . $id => 'integer|nullable',
            'maximumValue' . $id => 'integer|nullable',
            'placeholder' . $id => 'string|nullable'
        ]);

        try {
            $this->vraagService->update($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Gate::denies('raadsheer-onderdeel', Vraag::findOrFail($id)->formOnderdeel))
        {
            abort(403);
        }

        $this->vraagService->delete($id);
        $this->antwoordService->deleteFromVraag($id);
        try {
            $a = 4+4;
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol verwijderd!']);
    }

    public function undelete($id)
    {
        if (Gate::denies('raadsheer-onderdeel', Vraag::onlyTrashed()->findOrFail($id)->formOnderdeel))
        {
            abort(403);
        }

        try {
            $this->vraagService->undelete($id);
            $this->antwoordService->undelete(Antwoord::onlyTrashed()->where('vraag_id', $id)->get());
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol teruggezet!']);
    }

    public function permanentDelete($id)
    {
        if (Gate::denies('raadsheer-onderdeel', Vraag::withTrashed()->findOrFail($id)->formOnderdeel))
        {
            abort(403);
        }

        try {
            $this->antwoordService->permanentDelete(Antwoord::onlyTrashed()->where('vraag_id', $id)->get());
            $this->vraagService->permanentDelete($id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['error' => 'Succesvol permanent verwijderd!']);    }
}
