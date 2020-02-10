<?php

namespace App\Exports\GildeData;

use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;


class Vragen implements FromQuery, WithMapping, WithHeadings, WithTitle, WithEvents
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
        return 'Vragen';
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
        return ([
            $antwoord->vraag->tekst,
            $vraag->type == 'boolean' ? ($antwoord->antwoord ? 'Ja' : 'Nee') : $antwoord->antwoord,
            ucfirst($antwoord->formonderdeel->onderdeel)
        ]);
    }

    public function headings(): array
    {
        return [
            [
                'Aanpassing hier heeft geen zin!'
            ],[
                'Vraag',
                'Antwoord',
                'Inschrijfformulieronderdeel',
            ]
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray([
                    'font' => [     'bold' => true,
                ],  'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'ff0000']
                ]]);
            },
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
