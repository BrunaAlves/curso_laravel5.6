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

    @alerta(['tipo'=>'danger', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'warning', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'success', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'primary', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'secondary', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'info', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'dark', 'titulo'=>'Erro fatal'])
        <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    <script src="{{ URL:: to('js/app.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->

</body>
</html>