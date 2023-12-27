@extends('layouts.index')

@section('titulo','Caixa')

@section('conteudo')

@if(isset($msg))
    <div class="alert alert-success" role="alert">
  {{$msg}}
</div>
    @endif

<div class="card">
  <div class="card-header">
    Editar Movimentação
  </div>
  <div class="card-body">
    <form enctype="multipart/form-data" action="{{route('caixa-update',['id'=>$mov->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="tipo_mov" id="inlineRadio1" value="Entrada"
          @if($mov->tipo_mov == 'Entrada') checked @endif>
          <label class="form-check-label" for="inlineRadio1">Entrada</label>
        </div>
        <div class="form-check form-check-inline mb-4">
          <input class="form-check-input" type="radio" name="tipo_mov" id="inlineRadio2" value="Saída"
          @if($mov->tipo_mov == 'Saída') checked @endif>
          <label class="form-check-label" for="inlineRadio2">Saída</label>
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <input name="descr_mov" type="" class="form-control" id="" value="{{$mov->descr_mov}}">
        </div>
        <div class="form-group">
            <label>Data</label>
            <input name="data_mov" type="date" class="form-control" value="{{$mov->data_mov}}"></input>
        </div>
        <div class="form-group">
            <label>Valor</label>
            <input name="valor" type="number" step=".01" class="form-control" value="{{$mov->valor}}"></input>
        </div>
        <div class="form-group">
          <label for="inputState">Modo</label>
          <select name="modo_mov" id="inputState" class="form-control">
            @if(isset($mov->modo_mov))
            <option value="{{$mov->modo_mov}}" selected>{{$mov->modo_mov}}*</option>
            @else
            <option selected>Escolha um modo</option>
            @endif
            <option value="Transferência">Transferência</option>
            <option value="Cartão">Cartão</option>
            <option value="PIX">PIX</option>
            <option value="Dinheiro">Dinheiro</option>
          </select>
        </div>
        <div class="custom-file">
          <input name="comp[]" multiple type="file" class="custom-file-input" id="customFile">
          <label class="custom-file-label" for="customFile">Escolha o arquivo</label>
        </div>
        <table class="mb-3" cellpadding="10px">
          <thead>
          </thead>
          <tbody>
            @foreach($comp as $cmp)
            <tr>
              <td><a target="_blank" href="{{url("storage/$cmp->path")}}">{{$cmp->nome_arq}}</a></td>
              <td class="d-flex">
                  <button name="down" value="{{$cmp->path}}" style="margin-right: 5px;" class="btn btn-outline-primary" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                    <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                    <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                  </svg>
                  </button>
                    <button name="del" value="{{$cmp->id}}" type="submit" class="btn btn-outline-danger">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"></path>
                      </svg>
                    </button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">
    Caixa
  </div>
  <div class="card-body">
  <p><a href="{{route('caixa-export')}}">Baixar</a></p>
    <table cellpadding="10px" id="umptabela" class="table table-striped">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($caixa as $c)
            <tr>
                <td>{{$c->tipo_mov}}</td>
                <td>{{$c->descr_mov}}</td>
                <td>{{datas($c->data_mov)}}</td>
                <td>{{valor($c->valor)}}</td>
                <td class="d-flex">
                  <a style="margin-right: 5px;" class="btn btn-outline-primary" href="{{route('caixa-edit',['id'=>$c->id])}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                  </svg>
                  </a>
                  <form action="{{route('caixa-destroy',['id'=>$c->id])}}" method="POST">
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