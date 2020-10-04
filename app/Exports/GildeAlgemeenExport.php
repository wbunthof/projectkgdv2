<?php

namespace App\Exports;

use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class GildeAlgemeenExport implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * @inheritDoc
     */
    public function query()
    {
        return Gilde::query()->where('id', '>', 10);
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return ['NBFS', 'Naam', 'E-mailadres', 'Locatie', 'Dit jaar ingelogd?', 'Laatste login'];
    }

    /**
     * @inheritDoc
     */
    public function map($row): array
    {
        return [$row->id, $row->name, $row->email, $row->locatie, true ? 'Ja' : 'Nee', ];
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Informatie over alle gilden';
    }
}
