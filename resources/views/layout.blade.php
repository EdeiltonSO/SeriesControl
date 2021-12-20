<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de séries</title>
</head>
<body>
    <nav style="padding: 0px 10px;" class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 d-flex justify-content-between">
        <a href="{{ route('listar_series') }}" class="navbar-brand">Home</a>
        @auth
        <a href="/sair" class="text-danger">Sair</a>
        @endauth
        @guest
        <a href="/entrar">Entrar</a>
        @endguest
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1>@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>
</body>
</html>
