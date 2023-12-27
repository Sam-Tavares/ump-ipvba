@extends('layouts.index')

@section('titulo','Pedido')

@section('conteudo')

@if(isset($msg))
    <div class="alert alert-success" role="alert">
  {{$msg}}
</div>
    @endif

<div class="card">
  <div class="card-header">
    Pedido
  </div>
  <div class="card-body">

        <div class="form-group">
            <label>Pedido: <b>{{$ped->nome_ped}}</b></label>
        </div>
        <div class="card">
          <div class="card-header">
            Produtos:
          </div>

          <div class="card-body">
              <table cellpadding="10px">
                  <thead>
                      <tr>
                          <th>Nome</th>
                          <th>Qtd</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($prod_ped as $p)
                      <tr>
                          <td>{{$p->nome_prod}}</td>
                          <td>{{$p->qtd}}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
        </div>

    <form action="{{route('cozinha-update',['id'=>$ped->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Obs: </label>
            <span>{{$ped->obs_ped}}</span>
        </div>
        <p>Valor Total do Pedido: <b>R$ {{valor($total_ped)}}</b></p>
        <div class="form-group">
            <label><b>Status</b></label>
            <select name="status_ped" class="form-control">
                <option value="{{$ped->status_ped}}" selected>{{$ped->status_ped}}*</option>
                <option value="Enviado">Enviado</option>
                <option value="Em Processo">Em Processo</option>              
                <option value="Finalizado">Finalizado</option>              
            </select>
          </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</div>


@endsection