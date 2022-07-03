<?php

namespace App\Exports;

use App\Models\TabelaFretes;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTabelaFretes implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TabelaFretes::all();
    }
}
