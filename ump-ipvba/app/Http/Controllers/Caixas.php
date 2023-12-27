<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Caixa;
use App\Models\Comprovante;
use App\Exports\CaixasExport;
use Maatwebsite\Excel\Facades\Excel;


class Caixas extends Controller
{
    public function caixa(){
        $caixa = Caixa::all();

        $val_ent = Caixa::where('tipo_mov','Entrada')->sum('valor');
        $val_sai = Caixa::where('tipo_mov','Saída')->sum('valor');
        $saldo = $val_ent - $val_sai;
        return view('caixa', ['caixa'=>$caixa, 'saldo'=>$saldo]);
    }

    public function store(Request $request){
        Caixa::create($request->all());
        $caixa = Caixa::all();
        $msg = "Cadastro realizado com sucesso";

        $val_ent = Caixa::where('tipo_mov','Entrada')->sum('valor');
        $val_sai = Caixa::where('tipo_mov','Saída')->sum('valor');
        $saldo = $val_ent - $val_sai;
        return view('caixa', ['caixa'=>$caixa,'msg'=>$msg, 'saldo'=>$saldo]);
    }

    public function edit($id){
        $mov = Caixa::where('id',$id)->first();
        $caixa = Caixa::all();
        $comp = Comprovante::where('id_caixa',$id)->get();
        return view('caixa_editar',['mov'=>$mov,'caixa'=>$caixa, 'comp'=>$comp]);
    }

    public function update(Request $request, $id){

        if(isset($request->down)){
            return  response()->download("storage/".$request->down);
        }
        elseif(isset($request->del)){
            $comp = Comprovante::where('id',$request->del)->first();
            unlink("storage/".$comp->path);
            Comprovante::where('id',$request->del)->delete();
            return redirect()->route('caixa-edit',['id'=>$id]);
        }
        else{
            $data=[
                'tipo_mov' => $request->tipo_mov,
                'descr_mov' => $request->descr_mov,
                'data_mov' => $request->data_mov,
                'valor' => $request->valor,
                'modo_mov' => $request->modo_mov
                ];
        
                Caixa::where('id',$id)->update($data);
        
                $mov = Caixa::where('id',$id)->first();
                $caixa = Caixa::all();
                $comp = Comprovante::where('id_caixa',$id)->get();
                $msg = "Caixa atualizado com sucesso";
                if(!isset($request->comp)){        
                return view('caixa_editar',['mov'=>$mov, 'caixa'=>$caixa, 'msg'=>$msg, 'comp'=>$comp]);
                }
                else{

                    foreach($request->comp as $cpr){
                        $extension = $cpr->getClientOriginalExtension();
                        $novo_nome = 'comp'.uniqid().'.'.$extension;
                
                        $nome_arq = $cpr->getClientOriginalName();
                        $path = 'comp/'.$novo_nome;
                
                        $comp1 = [
                            'id_caixa' => $id,
                            'nome_arq' => $nome_arq,
                            'path' => $path
                        ];
                        
                        $envio = $cpr->storeAs('comp', $novo_nome);
                        Comprovante::create($comp1);
                    }

                    $comp = Comprovante::where('id_caixa',$id)->get();
                    return view('caixa_editar',['mov'=>$mov, 'caixa'=>$caixa, 'msg'=>$msg, 'comp'=>$comp]);
                }
        }
    }

    public function destroy($id){
        Caixa::where('id',$id)->delete();
        return redirect()->route('caixa');
    }

    public function export() 
    {
        return Excel::download(new CaixasExport, 'caixa.xlsx');
    }
}
