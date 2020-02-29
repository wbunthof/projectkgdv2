<?php

namespace App\Exports\FormonderdeelData;

use App\Formonderdeel;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DeelnameMeerdereWedstrijden implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    /**
     * @inheritDoc
     */

    public function query()
    {
        return \App\Deelnamemeerderewedstrijden::where('id', '>', 0);
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return ['Naam', 'Gilde','Klasse'];
    }

    /**
     * @inheritDoc
     */
    public function map($lid): array
    {
        return [
            $lid->naam,
            $lid->NBFS_id . $lid->gilde->name,
            $lid->disciplines
        ];
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Leden';
    }
}
