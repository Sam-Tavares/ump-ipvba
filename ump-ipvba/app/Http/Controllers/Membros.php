<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membro;
use App\Exports\MembrosExport;
use Maatwebsite\Excel\Facades\Excel;

class Membros extends Controller
{
    public function membros(){
        $memb = Membro::orderByRaw('MID(data_nasc, 9, 2) ASC')->get();
        $meses = array(
            1 => 'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        );
        return view('membros', ['memb'=>$memb, 'meses'=>$meses]);
    }

    public function store(Request $request){

        if(isset($request->pesq_cep)){

            error_reporting(E_ERROR);
            
            $cep = preg_replace("/[^0-9]/", "", $request->cep);
            $url = "http://viacep.com.br/ws/$cep/xml/";
            $xml = simplexml_load_file($url);            

            $memb = Membro::orderByRaw('MID(data_nasc, 9, 2) ASC')->get();
            $meses = array(
                1 => 'Janeiro',
                'Fevereiro',
                'Março',
                'Abril',
                'Maio',
                'Junho',
                'Julho',
                'Agosto',
                'Setembro',
                'Outubro',
                'Novembro',
                'Dezembro'
            );

            return view('membros', ['memb'=>$memb,'xml'=>$xml,'request'=>$request, 'meses'=>$meses]);
        } else {
        Membro::create($request->all());

        $memb = Membro::orderByRaw('MID(data_nasc, 9, 2) ASC')->get();
        $meses = array(
            1 => 'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        );
        $msg = "Cadastro realizado com sucesso";
        return view('membros', ['memb'=>$memb,'msg'=>$msg, 'meses'=>$meses]);
        }
    }

    public function edit($id){
        $mbro = Membro::where('id',$id)->first();
        $memb = Membro::all();
        return view('memb_editar',['mbro'=>$mbro,'memb'=>$memb]);
    }

    public function update(Request $request, $id){

        if(isset($request->pesq_cep)){

            error_reporting(E_ERROR);
            
            $cep = preg_replace("/[^0-9]/", "", $request->cep);
            $url = "http://viacep.com.br/ws/$cep/xml/";
            $xml = simplexml_load_file($url);
            
            $mbro = Membro::where('id',$id)->first();
            $memb = Membro::all();

            return view('memb_editar', ['mbro'=>$mbro,'memb'=>$memb,'xml'=>$xml]);
        } else {
        $data=[
        "Nome" => $request->Nome,
        "data_nasc" => $request->data_nasc,
        "email" => $request->email,
        "rede" => $request->rede,
        "telefone" => $request->telefone,
        "rua" => $request->rua,
        "num" => $request->num,
        "bairro" => $request->bairro,        
        "cidade" => $request->cidade,
        "estado" => $request->estado,
        "cep" => $request->cep,
        ];
        Membro::where('id',$id)->update($data);

        $mbro = Membro::where('id',$id)->first();
        $memb = Membro::all();
        $msg = "Atualização realizada com sucesso";
        return view('memb_editar',['mbro'=>$mbro, 'memb'=>$memb, 'msg'=>$msg]);
        }
    }

    public function destroy($id){
        Membro::where('id',$id)->delete();
        return redirect()->route('membros');
    }

    public function export() 
    {
        return Excel::download(new MembrosExport, 'membros.xlsx');
    }

    public function guGame(){
        return view('gu-game.index');
    }
}
