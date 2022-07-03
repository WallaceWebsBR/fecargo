<?php

namespace App\Exports;

use App\Models\Cotacoes;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCotacoes implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cotacoes::all();
    }
}
