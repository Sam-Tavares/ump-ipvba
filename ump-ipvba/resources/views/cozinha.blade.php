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
    Pedidos
  </div>
  <div class="card-body grid-c">
    @foreach($peds as $p)
    <a href="{{route('cozinha-edit', ['id'=>$p->id])}}">
    <div class="card ped">
      <div class="card-header">
        Pedido: {{$p->id}}
      </div>
      <div class="card-body">
        @if($p->status_ped == 'Enviado')
        <p><b>Status: </b><span style="color:red;">{{$p->status_ped}}</span></p>
        @elseif($p->status_ped == 'Em Processo')
        <p><b>Status: </b><span style="color:blue;">{{$p->status_ped}}</span></p>
        @else
        <p><b>Status: </b><span style="color:green;">{{$p->status_ped}}</span></p>
        @endif
        <p><b>Nome: </b>{{$p->nome_ped}}</p>
        <p><b>OBS: </b>**{{$p->obs_ped}}**</p>
      </div>
    </div>
    </a>


    @endforeach
  </div>
</div>



@endsection