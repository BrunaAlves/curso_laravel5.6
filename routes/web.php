<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { //função anomima que sera executada cada vez que o usuário executar a rota
    return view('welcome');
});

Route::get('/ola', function () { //utilização simples das rotas
    return "<h1>Seja Bem vindo!</h1>";
});

Route::get('/ola/sejabemvindo', function () { //utilização simples das rotas
    return "<h1>Olá, visitante! Seja Bem vindo!</h1>";
});

Route::get('/nome/{nome}/{sobrenome}', function($nome, $sn){ //{} é passado o parâmetro que é o nome da pessoa, no exemplo. Estamos nomeando um parametro que vai ser recebido. Toda vez que passar um parametro, deverar ser passado também na função
    return "<h1>Olá, $nome $sn!</h1>"; // isso será passado no browser, por exemplo: http://localhost:8000/nome/bruna/alves

});


Route::get('/repetir/{nome}/{n}', function($nome, $n){ // vai repetir o nome a quantidade de vezes que for passar no parametro n. Espera receber os 3 níveis, ou a rota não será encontrada. Não está restrito então os parametros recebem qualquer coisa
    if(is_integer($n)){ //o parametro n precisa ser inteiro nesse caso, por causa do proximo for
        for($i=0; $i<$n; $i++){
            echo "<h1>Olá, $nome!</h1>"; // exemplo browser: http://localhost:8000/repetir/bruna/10
        };
    }
    else
        echo "Você não digitou um inteiro";   
});

//PARAMETROS RESTRITOS

Route::get('/seunomecomregra/{nome}/{n}', function($nome, $n){
    for($i=0; $i<$n; $i++){
        echo "<h1>Olá, $nome! ($i) </h1>"; // exemplo browser: http://localhost:8000/repetir/bruna/10
    };
})->where('n', '[0-9]+')->where('nome', '[A-Za-z]+'); //expressão regular. restringir o n variando de 0 a 9 com 1 ou mais digito +

//PARAMETROS OPCIONAIS

Route::get('/seunomesemregra/{nome?}', function($nome=null){ // o parametro {?} com o ponto de interrogação faz com que ele seja opcional, entrando na rota sem o parametro. nome=null caso não receba nenhum nome, passa-se um parametro null(valor defult caso chame sem o nome)
    if(isset($nome)){ // para ser opcional é necessário uma verificação se o parametro foi setado, se não o echo vai esta vazio
        echo "<h1>Olá, $nome!</h1>"; //Exemplo:http://localhost:8000/seunomesemregra/Maria
    }
    else{
        echo "Você não passou nenhum nome"; //Exemplo:http://localhost:8000/seunomesemregra
    }

});