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
    <form action="{{route('pedido-store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nome do Pedido</label>
            <input name="nome_ped" type="" class="form-control" id="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">
    Pedidos - R$:{{valor($total_peds)}}
  </div>
  <div class="card-body">
    <table cellpadding="10px" id="umptabela" class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Status</th>
                <th>Total</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peds as $p)
            <tr>
              @if($p->status_ped == 'Preenchendo')
              <td><a href="{{route('prod', ['id'=>$p->id])}}">{{$p->nome_ped}}</a></td>
              @else
              <td>{{$p->nome_ped}}</td>
              @endif
                <td>{{$p->status_ped}}</td>
                <td>{{valor($p->total_ped)}}</td>
                <td class="d-flex">
                  <form action="{{route('pedido-destroy',['id'=>$p->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                      </svg>
                    </button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</div>


@endsection