<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    protected $fillable = [
            'Nome',
            'data_nasc',
            'email',
            'rede',
            'telefone',
            'rua',
            'bairro',
            'cidade',
            'estado',
            'cep',
            'num',
    ];

}
