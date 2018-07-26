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
                        <form action="/cliente" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome do Cliente</label>
                                <input type="text" id="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" name="nome" placeholder="Nome do Cliente">
                                @if($errors->has('nome'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('nome')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="idade">Idade do Cliente</label>
                                <input type="text" id="idade" class="form-control {{ $errors->has('idade') ? 'is-invalid' : '' }}" name="idade" placeholder="idade do Cliente">
                                @if($errors->has('idade'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('idade')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço do Cliente</label>
                                <input type="text" id="endereco" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" name="endereco" placeholder="Endereço do Cliente">
                                @if($errors->has('endereco'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('endereco')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email do Cliente</label>
                                <input type="text" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="Email do Cliente">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                    {{ $errors->first('email')}}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                            <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
                        </form>
                    </div>
                    @if($errors->any())
                        <div class="card-footer">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
    @if(isset($errors))
    {{ var_dump($errors)}}
    @endif
    <script src="{{ URL:: to('js/app.js')}}" type="text/javascript"></script>
    <!-- <script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->

</body>
</html>