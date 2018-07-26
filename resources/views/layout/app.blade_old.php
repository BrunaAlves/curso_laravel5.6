<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Meu título - @yield('titulo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
@section('barralateral')
    <p>Esta parte da seção é do template PAI</p>
@show
    <div>
        @yield('conteudo') <!-- Vai dizer pro laravel qual é a sessão que deve ser exibido -->
    </div>
</body>
</html>