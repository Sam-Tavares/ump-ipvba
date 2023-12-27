<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_ped',
        'desc_total',
        'obs_ped',
        'status_ped',
        'total_ped',
    ];
}
