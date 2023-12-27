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
            <form action="{{route('prod-store',['id'=>$ped->id])}}" method="POST">
            @csrf
            <div class="d-flex">
              <div class="form-group">
                <select name="prod" id="inputState" class="form-control">
                  <option selected>Escolha um Produto</option>
                  @foreach($prods as $prod)
                  <option value="{{$prod->id}}">{{$prod->nome_prod}} - R$: {{valor($prod->prec_prod)}}</option>
                  @endforeach
                </select>
              </div>
              <div class="d-flex form-group">
                  <input style="width: 100px" name="qtd" type="number"  class="form-control" placeholder="Qtd">
                <button name="create" type="submit" class="ml-2 btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                </button>
              </div>
            </form>
            </div>
              <table cellpadding="10px">
                  <thead>
                      <tr>
                          <th>Nome</th>
                          <th>Qtd</th>
                          <th>Preço Total</th>
                          <th>Ação</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($prod_ped as $p)
                      <tr>
                          <td>{{$p->nome_prod}}</td>
                          <td>{{$p->qtd}}</td>
                          <td>{{valor($p->qtd*$p->prec_unit)}}</td>
                          <td class="d-flex">
                            <form action="{{route('prod-destroy',['id'=>$ped->id, 'p'=>$p->id])}}" method="POST">
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
              <br>
              <p>Valor Total do Pedido: <b>R$ {{valor($total_ped)}}</b></p>
            </div>
          </div>


        <a style="color: #fff;" href="{{route('pedido-edit', ['id'=>$ped->id])}}"  class="btn btn-primary">Continuar</a>
  </div>
</div>


@endsection