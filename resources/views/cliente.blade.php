<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cadastro de Cliente</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{URL::to('css/app.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('css/app.css')}}" rel="stylesheet"> -->
    <style>
        body{ padding: 20px; }
    </style>
</head>
<body>

    <main role="main">
        <div class=row>
            <div class="container col-md-8 offset-md-2">
                <div class="card border">
                    <div class="card-header">
                        <div class="card-title">
                            Cadastro de Cliente
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="tabelaprodutos">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Idade</th>
                                    <th>Email</th>
                                </tr>
                            </thread>
                            <tbody>
                                @foreach($clientes as $c)
                                    <tr>
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->nome }}</td>
                                        <td>{{ $c->endereco }}</td>
                                        <td>{{ $c->idade }}</td>
                                        <td>{{ $c->email }}</td>
                                    </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ URL:: to('js/app.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->

</body>
</html>