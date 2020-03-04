<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use Illuminate\Http\Request;

class OrganiserDataController extends Controller
{
    public function formonderdeel(Formonderdeel $formonderdeel)
    {
        return view('organiser.formonderdeel')->with([
            'formonderdeel' => $formonderdeel
        ]);
    }
}
