<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cronograma;
use Illuminate\Support\Facades\Mail;
use App\Mail\CronogramaEmail;

class Cronogramas extends Controller
{
    public function inicial(){
        $crono = Cronograma::where('data','>=', anoatual().'-01-01')
        ->where('data','<=', anoatual().'-12-31')
        ->orderBy('data', 'asc')
        ->orderBy('horario', 'asc')
        ->get();

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

        return view('inicial', ['crono'=>$crono, 'meses'=>$meses]);
    }

    public function cronograma(){
        $crono = Cronograma::all();
        return view('cronograma', ['crono'=>$crono]);
    }

    public function store(Request $request){
        Cronograma::create($request->all());

        $crono = Cronograma::all();
        $msg = "Cadastro realizado com sucesso";
        return view('cronograma', ['crono'=>$crono,'msg'=>$msg]);
    }

    public function view($id){
        $prog = Cronograma::where('id',$id)->first();
        return view('view',['prog'=>$prog]);
    }

    public function edit($id){
        $prog = Cronograma::where('id',$id)->first();
        $crono = Cronograma::all();
        return view('crog_editar',['prog'=>$prog,'crono'=>$crono]);
    }

    public function update(Request $request, $id){
        $data=[
        "evento" => $request->evento,
        "descri" => $request->descri,
        "data" => $request->data,
        "horario" => $request->horario,
        "local" => $request->local,
        "end" => $request->end
        ];
        Cronograma::where('id',$id)->update($data);

        $prog = Cronograma::where('id',$id)->first();
        $crono = Cronograma::all();
        $msg = "Programação atualizada com sucesso";
        return view('crog_editar',['prog'=>$prog, 'crono'=>$crono, 'msg'=>$msg]);
    }

    public function destroy($id){
        Cronograma::where('id',$id)->delete();
        return redirect()->route('cronograma');
    }
    
}
