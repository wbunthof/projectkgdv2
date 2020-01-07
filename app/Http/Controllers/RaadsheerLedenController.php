<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use App\Formonderdelendiscipline;
use App\Leden;
use App\Services\DisciplineService;
use App\Services\LedenService;
use Exception;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RaadsheerLedenController extends Controller
{
    protected $ledenService;
    protected $validationRules;

    public function __construct(LedenService $ledenService)
    {
        $this->ledenService = $ledenService;
        $this->validationRules = [  'leden_id' => 'required|numeric',
                                    'voornaam' => 'required|string',
                                    'tussenvoegsel' => 'nullable|string',
                                    'achternaam' => 'required|string',
                                    'geboortedatum' => 'required|date',
                                    'straat' => 'nullable|string',
                                    'huisnummer' => 'nullable|alpha_num',
                                    'formonderdeel_id' => 'numeric|required'];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if (Gate::denies('raadsheer-onderdeel', Formonderdeel::findOrFail($request->formonderdeel_id))){
            abort(403);
        }

        $vaildation = $request->validate($this->validationRules);

        try {
            $this->ledenService->create($request);
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        if (Gate::denies('raadsheer-onderdeel', Leden::findOrFail($id)->formonderdeel)){
            abort(403);
        }

        $vaildation = $request->validate([$this->validationRules]);

        try {
            $this->ledenService->update($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol geüpdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        if (Gate::denies('raadsheer-onderdeel', Leden::findOrFail($id)->formonderdeel)){
            abort(403);
        }

        try {
            $this->ledenService->delete($id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol verwijderd!']);

    }
}
