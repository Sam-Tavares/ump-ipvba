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
    Cadastro de Pedido:
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
                          <th>Preço Total</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($prod_ped as $p)
                      <tr>
                          <td>{{$p->nome_prod}}</td>
                          <td>{{$p->qtd}}</td>
                          <td>{{valor($p->qtd*$p->prec_unit)}}</td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
        </div>

    <form action="{{route('pedido-update',['id'=>$ped->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Obs</label>
            <textarea name="obs_ped" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$ped->obs_ped}}</textarea>
        </div>
        <div class="form-group">
            <label>Desconto</label>
            <input value="{{$ped->desc_total}}" name="desc_total" type="number" step=".01" class="form-control"></input>
        </div>
        <p>Valor Total do Pedido: <b>R$ {{valor($total_ped)}}</b></p>


        <button type="submit" class="btn btn-primary">Finalizar</button>
    </form>
  </div>
</div>


@endsection