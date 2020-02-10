<?php

namespace App\Http\Controllers;

use App\Exports\GildeData;
use App\Formonderdeel;
use App\Gilde;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GildeDownloadController extends Controller
{
    public function all(Gilde $id)
    {
        if (Gate::denies('gilde-download', $id))
        {
            return abort('404');
        }

        return (new GildeData($id))->download('Inschrijfformulier Kringgildedag ' . Carbon::now()->year . ' ' . $id->id . '.xlsx');
    }
}
