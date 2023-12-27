<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod_ped extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ped',
        'nome_prod',
        'prec_unit',
        'qtd',
    ];
}
