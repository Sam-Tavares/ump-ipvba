<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMP - IPVBA - @yield('titulo')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{url('css\styles.css')}}">
    <link href="https://fonts.cdnfonts.com/css/humanst521-bt" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{url('img\favicon.png')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
</head>
<body>

<div id="wrapper">
  <div class="body-content">

  <nav >
        <div class="row">
            <div class="col-sm-6 nav-div">
                <a class="navbar-brand" href="{{route('inicial')}}">
                <img src="{{url('img\Marca_UMP_semescrita_negativo_branco.png')}}" class="d-inline-block align-top" alt="">
                </a>
                <a class="navbar-brand" href="{{route('inicial')}}">
                    UMP - IPB Vila Buenos Aires
                </a>            
            </div>            
            <div class="col-sm-6 nav-div">
            <ul class="nav">
                @if(isset(Auth::user()->name))
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('cronograma')}}">Cronograma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('membros')}}">Membros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('caixa')}}">Caixa</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Restaurante
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{route('produto')}}">Produtos</a>
                    <a class="dropdown-item" href="{{route('pedido')}}">Pedidos</a>
                    <a class="dropdown-item" href="{{route('cozinha')}}">Cozinha</a>
                    </div>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/>
                        </svg>
                    </a>
                </li>
            @endif
            </ul>
            </div>
        </div>
    </nav>

    @yield('conteudo')

  </div>
  <footer id="rodape">
    <p>&copy; <a href="{{route('login')}}" style="color: #fff">UMP-IPVBA</a></p>
  </footer>
</div>

@php
return Artisan::call('envio:cronogramas');
@endphp

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
new DataTable('#umptabela', {
    info: false,
    ordering: false,
});
</script>
</body>
</html>