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
    Programação
  </div>
  <div class="card-body">
    <form action="{{route('cronograma-update',['id'=>$prog->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label><b>Nome: </b></label>
            <span>{{$prog->evento}}</span>
          </div>
        <div class="form-group">
            <label><b>Descrição do evento: </b></label>
            <span>{{$prog->descri}}</span>
        </div>
        <div class="form-group">
            <label><b>Data: </b></label>
            <span>{{datas($prog->data)}}</span>
        </div>
        <div class="form-group">
            <label><b>Horário: </b></label>
            <span>{{hora_abrev($prog->horario)}}</span>
        </div>

        <div class="form-group">
            <label><b>Local: </b></label>
            <span>{{$prog->local}}</span>
        </div>        
        <div class="form-group">
            <label><b>Endereço: </b></label>
            <span>{{$prog->end}}</span>
          </div>
    </form>
  </div>
</div>


@endsection