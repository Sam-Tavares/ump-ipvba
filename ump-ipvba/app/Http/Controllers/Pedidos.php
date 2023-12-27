<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Prod_ped;

class Pedidos extends Controller
{
    public function pedido(){
        $peds = Pedido::all();
        $total_peds = Pedido::all()->sum('total_ped');
        return view('pedido', ['peds'=>$peds, 'total_peds'=>$total_peds]);
    }

    public function store(Request $request){
        $data = [
            'nome_ped' => $request->nome_ped,
            'status_ped' => 'Preenchendo'
        ];
        $ped = Pedido::create($data);
        return redirect()->route('prod', ['id'=>$ped->id]);
    }

    public function edit($id){
        $ped = Pedido::where('id',$id)->first();
        $prod_ped = Prod_ped::where('id_ped',$id)->get();

        $total = array();
        foreach ($prod_ped as $p) {
            $total [] = $p->qtd * $p->prec_unit;
        }

        $total_ped = array_sum($total)-$ped->desc_total;
        return view('final_ped',['ped'=>$ped, 'prod_ped'=>$prod_ped, 'total_ped'=>$total_ped]);
    }

    public function update(Request $request, $id){
       
        $ped = Pedido::where('id',$id)->first();
        $prod_ped = Prod_ped::where('id_ped',$id)->get();

        $total = array();
        foreach ($prod_ped as $p) {
            $total [] = $p->qtd * $p->prec_unit;
        }

        $total_ped = array_sum($total)-$ped->desc_total;

        $data=[
            "obs_ped" => $request->obs_ped,
            "desc_total" => $request->desc_total,
            "status_ped" => 'Enviado',
            "total_ped" => $total_ped,
            ];
            Pedido::where('id',$id)->update($data);

        $msg = "Pedido enviado com sucesso";
        return view('final_ped',['ped'=>$ped, 'prod_ped'=>$prod_ped, 'total_ped'=>$total_ped, 'msg'=>$msg]);
    }

    public function destroy($id){
        Pedido::where('id',$id)->delete();
        Prod_ped::where('id_ped',$id)->delete();
        return redirect()->route('pedido');
    }

    public function cozinha(){
        $peds = Pedido::where('status_ped','<>','Preenchendo')->get();
        return view('cozinha', ['peds'=>$peds]);
    }

    public function coz_edit($id){
        $ped = Pedido::where('id',$id)->first();
        $prod_ped = Prod_ped::where('id_ped',$id)->get();

        $total = array();
        foreach ($prod_ped as $p) {
            $total [] = $p->qtd * $p->prec_unit;
        }

        $total_ped = array_sum($total)-$ped->desc_total;
        return view('coz_editar',['ped'=>$ped, 'prod_ped'=>$prod_ped, 'total_ped'=>$total_ped]);
    }

    public function coz_up(Request $request, $id){
        $data=[
            "status_ped" => $request->status_ped
            ];
            Pedido::where('id',$id)->update($data);

        $msg = "Pedido atualizado com sucesso";
        return redirect()->route('cozinha');
    }
    
}
