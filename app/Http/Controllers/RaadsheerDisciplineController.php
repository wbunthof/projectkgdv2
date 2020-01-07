<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use App\Formonderdelendiscipline;
use App\Services\DisciplineService;
use Auth;
use Exception;
use Gate;
use Illuminate\Http\Request;

class RaadsheerDisciplineController extends Controller
{
    protected $disciplineService;

    public function __construct(DisciplineService $disciplineService)
    {
        $this->disciplineService = $disciplineService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if (Gate::denies('raadsheer-onderdeel', Formonderdeel::findOrFail($request->formonderdeel_id))){
            abort(403);
        }
        $vaildation = $request->validate([
            'naam' => 'required|string']);

        try {
            $this->disciplineService->create($request);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
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
        if (Gate::denies('raadsheer-onderdeel', Formonderdelendiscipline::findOrFail($id)->formonderdeel)){
            abort(403);
        }

        $vaildation = $request->validate([
            'naam' . $id => 'required|string',
        ]);

        try {
            $this->disciplineService->update($request, $id);
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
        if (Gate::denies('raadsheer-onderdeel', Formonderdelendiscipline::findOrFail($id)->formonderdeel)){
            abort(403);
        }

        try {
            $this->disciplineService->delete($id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Something went wrong, error: ' . $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol verwijderd!']);

    }
}
