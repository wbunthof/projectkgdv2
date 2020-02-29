<?php


namespace App\Exports\GildeData;


use App\Gilde;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class Junioren implements FromQuery, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    /**
     * @var Gilde
     */
    private $gilde;

    /**
     * Junioren constructor.
     * @param Gilde $gilde
     */
    public function __construct(Gilde $gilde)
    {
        $this->gilde = $gilde;
    }

    public function title(): string
    {
        return 'Junioren';
    }

    public function map($lid): array
    {
        return [
            $lid->voornaam . ' ' . $lid->achternaam,
            $lid->geboortedatum,
            ucfirst($lid->discipline->naam)
        ];
    }

    public function headings(): array
    {
        return [
            'Naam',
            'Geboortedatum',
            'Discipline',
        ];
    }

    /**
     * @inheritDoc
     */
    public function query()
    {
        return $this->gilde->junioren();
    }
}
