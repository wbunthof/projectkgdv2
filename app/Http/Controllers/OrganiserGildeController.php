<?php

namespace App\Http\Controllers;

use App\Exports\GildeAlgemeenExport;
use App\Exports\GildeData\GildeData;
use App\Gilde;
use App\Mail\remeber_new_questions;
use App\Vraag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrganiserGildeController extends Controller
{
    public function algemeen()
    {
        return view('organiser.gilden')
                    ->with('vragen', Vraag::all())
                    ->with('gilden', Gilde::orderBy('id')->where('id', '>', '100')->get());
    }

    public function algemeenDownload()
    {
        return (new GildeAlgemeenExport())->download('Inschrijfformulier Kringgildedag ' . Carbon::now()->year . ' Gilde algemeen.xlsx');
    }

    public function download(Gilde $gilde)
    {
        return (new GildeData($gilde))->download('Inschrijfformulier Kringgildedag ' . Carbon::now()->year . ' ' . $gilde->id . '.xlsx');

    }
}
