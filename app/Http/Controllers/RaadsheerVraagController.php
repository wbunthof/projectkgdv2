<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use App\Raadsheer;
use App\Vraag;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Auth;
use Exception;
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
        $vragen = Vraag::all();

        foreach ($vragen as $vraag){
            $vraag->type = $vraag->type;
            $vraag->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request)
    {

        $vaildation = $request->validate([
            'formonderdeel_id' => 'required|integer|exists:formonderdelen,id',
            'tekst' => 'required|string',
            'extrainfo' => 'string|nullable',
            'type' => 'required|string',
            'minimumValue' => 'integer|nullable',
            'maximumValue' => 'integer|nullable',
            'placeholder' => 'string|nullable'
        ]);

        if (!$this->can(Auth::user(), Formonderdeel::find($request->formonderdeel_id)))
        {
            return redirect()->back()->with(['error' => 'Not allowed, ask administrator for the needed rights.']);
        }

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
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request, $id);

        $vaildation = $request->validate([
            'tekst' . $id => 'required|string',
            'extrainfo' . $id => 'string|nullable',
            'type' . $id => 'required|string',
            'minimumValue' . $id => 'integer|nullable',
            'maximumValue' . $id => 'integer|nullable',
            'placeholder' . $id => 'string|nullable'
        ]);

        if (!$this->can(Auth::user(), Formonderdeel::find(Vraag::find($id)->formonderdeel_id)))
        {
            return back()->with(['error' => 'Not allowed, ask administrator for the needed rights.']);
        }

        try {
//            $this->vraagService->create($request);
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
        $validation = Validator::make(['id' => $id], ['id' => 'required|integer|exists:vraag,id']);
        if ($validation->fails())
        {
            return redirect()->back()->with(['error' => 'Vraag niet gevonden']);
        }

        if (!$this->can(Auth::user(), Formonderdeel::find(Vraag::find($id)->formonderdeel_id)))
        {
            return redirect()->back()->with(['error' => 'Not allowed, ask administrator for the needed rights.']);
        }

        try {
            $this->antwoordService->deleteFromVraag($id);
            $this->vraagService->delete($id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol!']);
    }


    protected function can(Raadsheer $raadsheer, Formonderdeel $formonderdeel)
    {
        return $raadsheer->formOnderdelen->contains($formonderdeel);
    }
}
