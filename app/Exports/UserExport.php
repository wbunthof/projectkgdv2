<?php

namespace App\Exports;

use App\Antwoord;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Antwoord::where('NBFS', 1225)->get();
    }
}
