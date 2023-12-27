<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_mov',
        'descr_mov',
        'data_mov',
        'valor',
        'modo_mov',
    ];
}
