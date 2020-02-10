<?php

namespace App\Exports;

use App\Antwoord;
use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GildeData implements FromQuery, WithMapping, WithHeadings
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

    public function map($antwoord): array
    {
        /*
         * When the type of the question is boolean the first part of the ternary gets excuted.
         * The first part makes from a 1 to a yes, and a 0 to a no.
         * The second part just gives the answer that is stored in the database.
         *
         */
        $vraag = $antwoord->vraag;
        return [
            $antwoord->vraag->tekst,
            $vraag->type == 'boolean' ? ($antwoord->antwoord ? 'Ja' : 'Nee') : $antwoord->antwoord,
            $antwoord->formonderdeel->onderdeel
        ];
    }

    public function headings(): array
    {
        return [
            'Vraag',
            'Antwoord',
            'Inschrijfformulieronderdeel',
        ];
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return $this->gilde->antwoorden();
    }
}
