<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'uf',
        'cidade',
        'cep',
        'peso',
        'valor',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'peso' => 'float',
    ];

    public function getValueAttribute($value) {
        return round($value, 1);
    }
}
