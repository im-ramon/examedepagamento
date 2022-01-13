<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdicHabilitacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'altos_estudos_I',
        'altos_estudos_II',
        'aperfeicoamento',
        'especializacao',
        'formacao',
        'sem_formacao',
        'periodo_ini',
        'periodo_fim',
    ];
}
