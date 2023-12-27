<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prod_ped;
use App\Models\Pedido;
use App\Models\Produto;

class Prod_peds extends Controller
{
    public function prod_ped($id){
        $ped = Pedido::where('id',$id)->first();
        $prods = Produto::all();
        $prod_ped = Prod_ped::where('id_ped',$id)->get();

        $total = array();
        foreach ($prod_ped as $p) {
            $total [] = $p->qtd * $p->prec_unit;
        }

        $total_ped = array_sum($total);

        return view('prod_ped', ['ped'=>$ped, 'prods'=>$prods, 'prod_ped'=>$prod_ped, 'total_ped'=>$total_ped]);
    }

    public function store(Request $request, $id){
        $prod = Produto::where('id',$request->prod)->first();
        $data = [
            'id_ped' => $id,
            'nome_prod' => $prod->nome_prod,
            'prec_unit' => $prod->prec_prod,
            'qtd' => $request->qtd,
        ];
        Prod_ped::create($data);

        return redirect()->route('prod', ['id'=>$id]);
    }

    public function destroy($id, $p){
        Prod_ped::where('id',$p)->delete();
        return redirect()->route('prod', ['id'=>$id]);
    }
}
