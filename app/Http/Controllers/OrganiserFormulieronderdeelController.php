<?php

namespace App\Http\Controllers;

use App\Exports\FormonderdeelData\FormonderdeelExport;
use App\Formonderdeel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrganiserFormulieronderdeelController extends Controller
{
    public function algemeen()
    {
        return view('organiser.formonderdeelAlgemeen')
                ->with(['formulieronderdelen' => Formonderdeel::whereKeyNot(0)->get()]);
    }

    public function show(Formonderdeel $formulieronderdeel)
    {
        return view('organiser.formonderdeel')
                ->with(['formonderdeel' => $formulieronderdeel]);
    }

    public function download(Formonderdeel $formulieronderdeel)
    {
        return (new FormonderdeelExport($formulieronderdeel))->download('Inschrijfformulier Kringgildedag ' . Carbon::now()->year . ' ' . $formulieronderdeel->onderdeel . '.xlsx');
    }
}
