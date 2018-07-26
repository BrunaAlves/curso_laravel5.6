<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{URL::to('css/app.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->
</head>
<body>

    @if(isset($produtos))

        @if(count($produtos) == 0)
            <h1>Nenhum produto</h1>
        @elseif (count($produtos) === 1)
            <h1> Um produtos</h1>
        @else
        <h1> Temos vários produtos</h1>
        @endif

        @foreach($produtos as $p)
            <p> Nome: {{$p}} </p>
        @endforeach

    @else
        <h2>Variável produtos não foi passada como parâmetro.</h2>
    @endif

    @empty($produtos)
        <h1> Nada em produtos</h1>
    @endempty
    <script src="{{ URL:: to('js/app.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->

</body>
</html>