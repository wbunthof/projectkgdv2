<?php

namespace App\Http\Controllers;

use App\Antwoord;
use App\Formonderdeel;
use App\Raadsheer;
use App\Vraag;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Auth;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Redirect;
use Validator;

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
            'extrainfo' => 'string|nullable',
            'type' => 'required|string',
            'minimumValue' => 'integer|nullable',
            'maximumValue' => 'integer|nullable',
            'placeholder' => 'string|nullable'
        ]);

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
     * @return \Illuminate\Http\Response
     */
    public function showData($id)
    {
        if (Gate::denies('raadsheer-onderdeel', Vraag::findOrFail($id)->formOnderdeel)){
            abort(403);
        }

//        return
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

        if ($this)

        try {
            $this->vraagService->update($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e]);
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
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e]);
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
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol teruggezet!']);
    }

    public function permanentDelete()
    {
        return true;
    }
}
