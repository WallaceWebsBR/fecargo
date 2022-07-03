<?php

namespace App\Imports;

use App\Models\TabelaFretes;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportTabelaFretes implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TabelaFretes([
            'id' => $row[0] ?? null,
            'cidade' => $row[1],
            'uf' => $row[2],
            'taxa_minima' => $row[3],
            'por_kg' => $row[4],
            'por_km' => $row[5],
            'nome_tabela' => $row[6] ?? 'tabela_principal',
            'SEGURO' => $row[8] ?? '',
        ]);
    }
}
