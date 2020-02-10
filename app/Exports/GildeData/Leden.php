<?php

namespace App\Exports\GildeData;

use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class Leden  implements FromQuery, WithMapping, WithHeadings, WithTitle
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

    public function title(): string
    {
        return 'Leden';
    }

    public function map($lid): array
    {
        return [
            $lid->leden_id,
            $lid->voornaam . ' ' . $lid->tussenvoegsel . ' ' . $lid->achternaam,
            ucfirst($lid->formonderdeel->onderdeel),
            $lid->discipline->naam
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Naam',
            'Formulieronderdeel',
            'Klasse',
        ];
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return $this->gilde->leden();
    }
}
