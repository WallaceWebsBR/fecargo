<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelaFretes extends Model
{
    use HasFactory;

    protected $table = 'tabela_fretes';

    protected $fillable = [
        'uf',
        'cidade',
        'taxa_minima',
        'por_kg',
        'por_km',
        'nome_tabela',
        'SEGURO',
    ];

    protected $cast = [
        'taxa_minima' => 'float',
        'por_kg' => 'float',
        'por_km' => 'float',
    ];
}
