<?php

namespace App\Exports\FormonderdeelData;

use App\Formonderdeel;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class Leden implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    /**
     * @var Formonderdeel
     */
    private $formonderdeel;

    public function __construct(Formonderdeel $formonderdeel)
    {
        $this->formonderdeel = $formonderdeel;
    }

    /**
     * @inheritDoc
     */

    public function query()
    {
        return $this->formonderdeel->leden();

    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return ['Id', 'Naam', 'Gilde', 'Klasse'];
    }

    /**
     * @inheritDoc
     */
    public function map($lid): array
    {
        return [
            $lid->leden_id,
            $lid->voornaam . ' ' . $lid->tussenvoegsel . ' ' . $lid->achternaam,
            $lid->gilde_id . $lid->gilde->name,
            $lid->discipline->naam
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
