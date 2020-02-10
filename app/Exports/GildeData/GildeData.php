<?php

namespace App\Exports\GildeData;

use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GildeData implements WithMultipleSheets
{
    use Exportable;

    private $gilde;

    /**
     * @var Gilde|Gilde[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */

    public function __construct(Gilde $gilde)
    {
        $this->gilde = $gilde;
    }

    public function sheets(): array
    {
        $array =  [    new Vragen($this->gilde),
            new Leden($this->gilde),
            new Junioren($this->gilde),
            new DeelnameMeerdereWedstrijden($this->gilde),
        ];

        return $array;
    }

}
