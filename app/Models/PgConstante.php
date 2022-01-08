<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PgConstante extends Model
{
    use HasFactory;

    protected $fillable = [
        'pg',
        'pg_abrev',
        'adic_mil',
        'soldo',
    ];
}
