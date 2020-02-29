<?php

namespace App\Exports\FormonderdeelData;

use App\Formonderdeel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class Junioren implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    /**
     * @inheritDoc
     */

    public function query()
    {
        return \App\Junioren::where('id', '>', 0);
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return ['Naam', 'Geboortedatum', 'Gilde', 'Klasse'];
    }

    /**
     * @inheritDoc
     */
    public function map($lid): array
    {
        return [
            $lid->voornaam . ' ' . $lid->achternaam,
            $lid->geboortedatum,
            $lid->gilde_id . $lid->gilde->name,
            $lid->discipline->naam
        ];
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Junioren';
    }
}
