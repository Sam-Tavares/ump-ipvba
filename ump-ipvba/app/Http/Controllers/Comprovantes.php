<?php

namespace App\Http\Controllers;
use App\Models\Caixa;
use App\Models\Comprovante;

use Illuminate\Http\Request;

class Comprovantes extends Controller
{
    public function store($request, $id){
        dd($request);
            $extension = $request->comp->getClientOriginalExtension();
            $novo_nome = 'comp'.uniqid().'.'.$extension;
    
            $nome_arq = $request->comp->getClientOriginalName();
            $path = 'comp/'.$nome_arq;
    
            $comp = [
                'id_caixa' => $id,
                'nome_arq' => $nome_arq,
                'path' => $path
            ];
            
            $envio = $request->comp->storeAs('comp', $novo_nome);
            Comprovante::create($comp);
            return view('caixa_editar',['mov'=>$mov, 'caixa'=>$caixa, 'msg'=>$msg]);
    }
}
