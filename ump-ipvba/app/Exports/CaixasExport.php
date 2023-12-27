<?php

namespace App\Exports;

use App\Models\Caixa;
use Maatwebsite\Excel\Concerns\FromCollection;

class CaixasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Caixa::all();
    }
}
