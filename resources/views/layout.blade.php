<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de séries</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-2 d-flex justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Página Inicial</a>

        @auth
        <a class="navbar-brand" href="/sair">Sair</a>
        @endauth
        @guest
        <a class="navbar-brand" href="/entrar">Entrar</a>
        @endguest
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1>@yield('cabecalho')</h1>
    </div>
    @yield('conteudo')
</div>

</body>
</html>
