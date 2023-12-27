@extends('layouts.index')

@section('titulo',$mbro->Nome)

@section('conteudo')

@if(isset($msg))
    <div class="alert alert-success" role="alert">
  {{$msg}}
</div>
    @endif

<div class="card">
  <div class="card-header">
    Cadastro de Membros
  </div>
  <div class="card-body">
    <form action="{{route('membros-update',['id'=>$mbro->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nome</label>
            <input  
            value="{{$mbro->Nome}}"
            name="Nome" type="" class="form-control" id="" placeholder="Nome Completo">
        </div>
        <div class="form-group">
            <label>Data de Nascimento</label>
            <input  
            value="{{$mbro->data_nasc}}"
            name="data_nasc" type="date" class="form-control"></input>
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input   
            value="{{$mbro->email}}"
            name="email" type="" class="form-control" id="" placeholder="email@email.com">
        </div>
        <div class="form-group">
            <label>Rede Social</label>
            <input   
            value="{{$mbro->rede}}"
            name="rede" type="" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input   
            value="{{$mbro->telefone}}"
            name="telefone" type="" class="form-control" id="" placeholder="(00)90000-0000">
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputCEP">CEP</label>
            <div class="form-row">
              <input
            @if(isset($xml)) 
            value="{{$xml->cep}}"
            @else
            value="{{$mbro->cep}}"
            @endif
            name="cep" type="text" class="col form-control ml-1" id="inputCEP" placeholder="00000-000">
              <button name="pesq_cep" value="1" type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg>
              </button>
            </div>
          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress">Rua</label>
            <input
            @if(isset($xml)) 
            value="{{$xml->logradouro}}"
            @else
            value="{{$mbro->rua}}"
            @endif
            name="rua" class="form-control" id="inputAddress" placeholder="Rua dos Bobos">
          </div>
          <div class="form-group col-md-2">
            <label for="inputAddress">N°</label>
            <input   
            value="{{$mbro->num}}"
            name="num" type="text" class="form-control" id="inputAddress" >
          </div>
        </div>        
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputAddress2">Bairro</label>
            <input
            @if(isset($xml)) 
            value="{{$xml->bairro}}"
            @else
            value="{{$mbro->bairro}}"
            @endif
            name="bairro" class="form-control" id="inputAddress2" placeholder="Jd. das Flores">
          </div>
          <div class="form-group col-md-6">
            <label for="inputCity">Cidade</label>
            <input
            @if(isset($xml)) 
            value="{{$xml->localidade}}"
            @else
            value="{{$mbro->cidade}}"
            @endif
            name="cidade" class="form-control" id="inputCity" placeholder="São Paulo">
          </div>
          <div class="form-group col-md-2">
            <label for="inputEstado">Estado</label>
            <select name="estado" id="inputEstado" class="form-control">
            @if(isset($xml)) 
            <option value="{{$xml->uf}}" selected>{{$xml->uf}}</option>
            @endif
            <option value="{{$mbro->estado}}">{{$mbro->estado}}</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
              <option value="EX">Estrangeiro</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">
    Membros
  </div>
  <div class="card-body">
  <p><a href="{{route('membros-export')}}">Baixar</a></p>
    <table cellpadding="10px" id="umptabela" class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Nasc.</th>
                <th>Telefone</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($memb as $m)
            <tr>
                <td>{{$m->Nome}}</td>
                <td>{{datas($m->data_nasc)}}</td>
                <td>{{$m->telefone}}</td>
                <td class="d-flex">
                  <a style="margin-right: 5px;" class="btn btn-outline-primary" href="{{route('membros-edit',['id'=>$m->id])}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                  </svg>
                  </a>
                  <form action="{{route('membros-destroy',['id'=>$m->id])}}" method="POST">
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