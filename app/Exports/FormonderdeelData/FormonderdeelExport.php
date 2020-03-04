<?php

namespace App\Exports\FormonderdeelData;

use App\Formonderdeel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FormonderdeelExport implements WithMultipleSheets
{
    use Exportable;

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
    public function sheets(): array
    {
        $return = [];
        if ($this->formonderdeel->vragen)
        {
                $return[] = new VragenOverzicht($this->formonderdeel);
                foreach ($this->formonderdeel->vraag as $vraag) {
                        $return[] = new Vragen($vraag);
                }
        }

        if ($this->formonderdeel->leden)
        {
                $return[] = new Leden($this->formonderdeel);
        }

        if ($this->formonderdeel->junioren)
        {
                $return[] = new Junioren();
        }

        if ($this->formonderdeel->meerderewedstrijden)
        {
                $return[] = new DeelnameMeerdereWedstrijden();
        }

        return $return;
    }
}
