<?php


namespace App\Exports\GildeData;


use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DeelnameMeerdereWedstrijden implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * @var Gilde
     */
    private $gilde;

    /**
     * DeelnameMeerdereWedstrijden constructor.
     * @param Gilde $gilde
     */
    public function __construct(Gilde $gilde)
    {
        $this->gilde = $gilde;
    }

    public function title(): string
    {
        return 'Deelname Meerdere Wedstrijden';
    }

    public function map($lid): array
    {
        return ([
            $lid->naam,
            $lid->disciplines
        ]);
    }

    public function headings(): array
    {
        return [
            'Naam',
            'Disciplines',
        ];
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return $this->gilde->deelnamMeerdereWedstrijden();
    }
}
