<?php

namespace App\Exports;

use App\Gilde;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelSimpleCollection implements FromCollection
{
    /**
     * @var Collection
     */
    private $collection;

    public function __construct(Collection $collection)
    {

        $this->collection = $collection;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->collection;
    }
}
