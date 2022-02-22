<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracheque extends Model
{
    use HasFactory;

    protected $fillable = [
        'ficha_auxiliar_json',
        'users_id',
    ];
}
