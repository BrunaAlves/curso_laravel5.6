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
    
    @hasSection('minha_secao_produtos')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" style="width: 500px; margin:10px;"> Produtos</h5>

            <p class="card-text"> @yield('minha_secao_produtos') </p>
            <a href="#" class="card-link"> Informações </a>
            <a href="#" class="card-link"> Ajuda </a>
        </div>
    </div>
    @endif
    

    <script src="{{ URL:: to('js/app.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->

</body>
</html>