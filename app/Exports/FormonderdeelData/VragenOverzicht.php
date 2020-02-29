<?php

namespace App\Exports\FormonderdeelData;

use App\Formonderdeel;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class VragenOverzicht implements FromQuery, WithMapping, WithHeadings, WithTitle
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
        return $this->formonderdeel->vraag();
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return ['Id', 'Vraag'];
    }

    /**
     * @inheritDoc
     */
    public function map($vraag): array
    {
        return [
            $vraag->id,
            $vraag->tekst,
        ];
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Overzicht vragen';
    }
}
