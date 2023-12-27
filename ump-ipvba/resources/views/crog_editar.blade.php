@extends('layouts.index')

@section('titulo',$prog->evento)

@section('conteudo')

@if(isset($msg))
    <div class="alert alert-success" role="alert">
  {{$msg}}
</div>
    @endif

<div class="card">
  <div class="card-header">
    Cadastro de Programações
  </div>
  <div class="card-body">
    <form action="{{route('cronograma-update',['id'=>$prog->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nome</label>
            <input value="{{$prog->evento}}" name="evento" type="" class="form-control" id="" placeholder="Nome da Programação">
        </div>
        <div class="form-group">
            <label>Descrição do evento</label>
            <textarea name="descri" class="form-control" id="" rows="3">{{$prog->descri}}</textarea>
        </div>
        <div class="form-group">
            <label>Data</label>
            <input value="{{$prog->data}}" name="data" type="date" class="form-control"></input>
        </div>
        <div class="form-group">
            <label>Horário</label>
            <input value="{{$prog->horario}}" name="horario" type="time" class="form-control"></input>
        </div>

        <div class="form-group">
            <label for="inputAddress">Local</label>
            <input value="{{$prog->local}}" name="local" type="text" class="form-control" placeholder="IPB Vila Buenos Aires">
        </div>        
        <div class="form-group">
            <label for="inputAddress">Endereço</label>
            <input value="{{$prog->end}}" name="end" type="text" class="form-control" placeholder="Rua dos Bobos, nº 0">
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">
    Programações
  </div>
  <div class="card-body">
    <table cellpadding="10px" id="umptabela" class="table table-striped">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Descrição</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($crono as $c)
            <tr>
                <td>{{$c->evento}}</td>
                <td>{{$c->descri}}</td>
                <td>{{datas($c->data)}}</td>
                <td>{{hora_abrev($c->horario)}}</td>
                <td class="d-flex">
                  <a style="margin-right: 5px;" class="btn btn-outline-primary" href="{{route('cronograma-edit',['id'=>$c->id])}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                  </svg>
                  </a>
                  <form action="{{route('cronograma-destroy',['id'=>$c->id])}}" method="POST">
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