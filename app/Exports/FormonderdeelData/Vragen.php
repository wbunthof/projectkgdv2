<?php

namespace App\Exports\FormonderdeelData;

use App\Formonderdeel;
use App\Gilde;
use App\Vraag;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class Vragen implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * @var Formonderdeel
     * @var Gilde[]|\Illuminate\Database\Eloquent\Collection
     */
    private $vraag;
    private $gilden;

    public function __construct(Vraag $vraag)
    {
        $this->vraag = $vraag;
        $this->gilden = Gilde::all();
    }

    /**
     * @inheritDoc
     */

    public function query()
    {
        return $this->vraag->antwoord()->orderBy('NBFS');
    }

    /**
     * @inheritDoc
     */
    public function map($antwoord): array
    {
        if ($this->vraag->type === 'boolean')
        {
            return [$antwoord->gilden->id . $antwoord->gilden->name, $antwoord->antwoord ? 'Ja' : 'Nee'];
        } else {
            return [$antwoord->gilden->id . $antwoord->gilden->name, $antwoord->antwoord];
        }
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return ['NBFS, gilde', 'Antwoord'];
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return substr($this->vraag->id . ' ' . preg_replace('/[^a-zA-Z0-9 ]/', '', $this->vraag->tekst), 0, 31);
    }
}
