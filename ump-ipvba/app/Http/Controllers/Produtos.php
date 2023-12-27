<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class Produtos extends Controller
{
    public function produto(){
        $prods = Produto::all();
        return view('produto', ['prods'=>$prods]);
    }

    public function store(Request $request){
        Produto::create($request->all());

        $prods = Produto::all();
        $msg = "Cadastro realizado com sucesso";
        return view('produto', ['prods'=>$prods,'msg'=>$msg]);
    }

    public function edit($id){
        $prod = Produto::where('id',$id)->first();
        $prods = Produto::all();
        return view('prod_editar',['prod'=>$prod,'prods'=>$prods]);
    }

    public function update(Request $request, $id){
        $data=[
        "nome_prod" => $request->nome_prod,
        "prec_prod" => $request->prec_prod,
        ];
        Produto::where('id',$id)->update($data);

        $prod = Produto::where('id',$id)->first();
        $prods = Produto::all();
        $msg = "Produto atualizado com sucesso";
        return view('prod_editar',['prod'=>$prod, 'prods'=>$prods, 'msg'=>$msg]);
    }

    public function destroy($id){
        Produto::where('id',$id)->delete();
        return redirect()->route('produto');
    }
    
}
