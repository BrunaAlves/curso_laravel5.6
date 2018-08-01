<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Categoria;
use App\Cliente;
use App\Endereco;

Route::get('/', function () { //função anomima que sera executada cada vez que o usuário executar a rota
    return view('pagina');
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

//Agrupamento de rotas. Utiliza quando quer montar uma hierarquia. Ex. Produtos/info/codigoproduto

Route::prefix('app')->group(function(){ //Por questao de organização, é possivel criar a hierarquia de forma mais evidente.
    Route::get("/", function(){
        return "Pagina principal do APP"; //Exemplo: http://localhost:8000/app
    });
    Route::get("profile", function(){
        return "Pagina Profile";//Exemplo: http://localhost:8000/app/profile
    });
    Route::get("about", function(){
        return "Meu About"; //Exemplo: http://localhost:8000/app/about
    });
});

//REDIRECIONAMENTO

Route::redirect('/aqui', '/ola', 301); //Tudo que chegar no "aqui" será redirecionado para o "ola". Código 301 Vai falar para o browser que o /aqui foi removido para o /ola

//Direcionar para a view
Route::view('/hello', 'hello'); //função anomima que sera executada cada vez que o usuário executar a rota. Somente o nome do arquivo, sem a extensão do mesmo.

//Passar parâmetros da rota para a view. 
Route::view('/viewnome', 'hellonome', 
            ['nome'=>'Bruna', 'sobrenome'=> 'Alves']); //Primeiro parametro é a rota e o segundo é a view. Array associativo, com o primeiro indice nome e o segundo sobrenome, seguido cada um de seus parametros que esperam ser recebidos na view

//Passar o parametro depois da rota e mandar pra view

Route::get('/hellonome/{nome}/{sobrenome}', function($nome, $sn){
    return view('hellonome', 
                ['nome'=>$nome, 'sobrenome'=> $sn]); //Exemplo: http://localhost:8000/hellonome/Bruna/Alves
});


//MÉTODOS HTTP(baixar extensão Google Chrome "Advanced REST client")

Route::get('/rest/hello', function(){
    return "Hello (GET)";
});

Route::post('/rest/hello', function(){
    return "Hello (POST)";
});

Route::delete('/rest/hello', function(){
    return "Hello (DELETE)";
});

Route::put('/rest/hello', function(){
    return "Hello (PUT)";
});

Route::patch('/rest/hello', function(){
    return "Hello (PATCH)";
});

Route::options('/rest/hello', function(){
    return "Hello (OPTIONS)";
});

//METODOS HTTP COM REQUEST

Route::post('/rest/imprimir', function(Request $req){ //Pega os dados de um formulario(por exemplo) enviado por post, put etc.
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    return "Hello $nome ($idade)!! (POST)";
});

Route::match(['get','post'], '/rest/hello2', function(){ //Agrupar varios metodos para uma mesma função. Ordem dos parametros: métodos que serão atendidos na requisição, seguido da rota que esta configurando e o que será feito assim que chegar a requisição.
    return "Hello World 2";
});

Route::any('/rest/hello3', function(){ //Atender qualquer métodos Http.
    return "Hello World 3";
});

//NOMEANDO ROTAS

Route::get('/produtos', function(){
    echo "<h1>Produtos</h1>";
    echo "<ol>";
    echo "<li>Notebook</li>";
    echo "<li>Impressora</li>";
    echo "<li>Mouse</li>";
    echo "</ol>";

})->name('meusprodutos'); //nome da rota. Verificar em php artisan route:list

Route::get('/linkprodutos', function(){ //caso a rota seja alterada, é mais seguro pois foi utilizado o nome da rota e não a tag da rota.
    $url = route('meusprodutos');
    echo "<a href=\"". $url. "\">Meus produtos</a>";
});

Route::get("/redirecionarprodutos", function(){
    return redirect()->route('meusprodutos');
});

//----------------------------FIM DO TÓPICO DE ROTAS

//----------------------------INICIO TÓPICO DE CONTROLLER

Route::get('/nome', 'MeuControlador@getNome'); //Manda uma requisição que vai direto para o meu controlador. Nome da rota, nomedocontrolador@nomedafuncao. Quando eu colocar /nome, automaticamente vai chamar o metodo do meu controlador. Dentro do controlador eu faço o tratamento da requisição.

Route::get('/idade', 'MeuControlador@getIdade'); //Passando parametros para o controlador

Route::get('/multiplicar/{n1}/{n2}', 'MeuControlador@multiplicar'); //Faz uma requisição para controlador@multiplicar já passando os dois parametros para o metodo do controller

Route::get('nomes/{id}', 'MeuControlador@getNomeByID'); //Exemplo: http://localhost:8000/nomes/1

//REQUISIÇÕES HTTP

Route::resource('/cliente', 'ClienteControlador'); //Ao criar um controllador Resource, essa rota cria outras rotas para cada metodo HTTP

Route::post('/cliente/requisitar', 'ClienteControlador@requisitar');

//----------------------------FIM TÓPICO DE CONTROLLER

//----------------------------INICIO TÓPICO DE VIEW

Route::get('/primeiraview', function(){
    return view('minhaview');
});

Route::get('/ola', function(){
    return view('minhaview')
        ->with('nome', 'Joana')
        ->with('sobrenome', 'Amaral'); //declaro a "variavel" e seu valor, que será passado para a view(no caso a "minhaview")
});

Route::get('/ola/{nome}/{sobrenome}', function($nome, $sobrenome){
    /*
    return view('minhaview')
        ->with('nome', $nome)
        ->with('sobrenome', $sobrenome); //parametros serão passados na url
    */
    /*
    $parametros = ['nome'=>$nome, 'sobrenome'=>$sobrenome]; //Array associativo
    return view ('minhaview', $parametros);
    */
    return view('minhaview', compact('nome', 'sobrenome')); //funcao do php, que passasse as variaveis e ele monta o array associativo através da função
});

Route::get('/email/{email}', function($email){
    if(View::exists('email')) //metodo static que verifica se uma view existe
        return view('email', compact('email'));
    else
        return view('erro');
});

Route::get('/produtos', 'ProdutoControlador@listar');

Route::get('/secaoprodutos/{palavra}', 
           'ProdutoControlador@secaoprodutos');

Route::get('/mostraropcoes', 'ProdutoControlador@mostrar_opcoes');

Route::get('/opcoes/{opcao}', 'ProdutoControlador@opcoes');

Route::get('/loop/for/{n}', 'ProdutoControlador@loopFor');

Route::get('/loop/foreach', 'ProdutoControlador@loopForeach');


//INICIO MODELOS: QUERIES SQL

Route::get('/categorias', function(){ //SELECT
    $cats = DB::table('categorias')->get();
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";

    $nomes = DB::table('categorias')->pluck('nome'); //retorna todos os nomes
    foreach($nomes as $nome){
        echo "$nome <br>";
    }

    echo "<hr>";

    $cats = DB::table('categorias')->where('id', 1)->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";
    
    $cats = DB::table('categorias')->where('id', 1)->first(); //pegar somente um elemento sem utilizar array
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    
    echo "<p>Retornar um Array utilizando like</p>";

    $cats = DB::table('categorias')->where('nome', 'like', '%p%')->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Sentenças lógicas</p>";

    $cats = DB::table('categorias')->where('id', 1)->orWhere('id', 2)->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Intervalo</p>";

    $cats = DB::table('categorias')->whereBetween('id', [1, 4])->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Fora do Intervalo</p>";

    $cats = DB::table('categorias')->whereNotBetween('id', [1, 3])->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Conjunto</p>";

    $cats = DB::table('categorias')->whereIn('id', [1, 3, 4])->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Fora do Conjunto</p>";

    $cats = DB::table('categorias')->whereNotIn('id', [1, 3, 4])->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Sentenças lógicas</p>";

    $cats = DB::table('categorias')->where([
        ['id', 1],
        ['nome', 'roupas']
    ])->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Ordenando por nome</p>";

    $cats = DB::table('categorias')->orderBy('nome')->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p>Ordenando por nome(decrescente)</p>";

    $cats = DB::table('categorias')->orderBy('nome', 'desc')->get(); //array contendo um element
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

});

Route::get('/novascategorias', function(){ //INSERT
    DB::table('categorias')->insert([
        ['nome' => 'Cama mesa e banho'],
        ['nome' => 'Informática'],
        ['nome'=> 'Cozinha']
    ]);
    
    /*
        $id = DB::table('categorias')->insertGetId(['nome' => 'Carros']);

        echo "Novo ID = $id <br>";
    */
});

Route::get('/atualizandocategorias', function(){ //UPDATE

    $cat = DB::table('categorias')->where('id', 1)->first();
    echo "<p> Antes da atualização </p>";
    echo "id: " . $cat->id . "; ";
    echo "nome: " . $cat->nome . "<br> ";

    DB::table('categorias')->where('id', 1)->update(['nome'=> 'Roupas infantis']);

    $cat = DB::table('categorias')->where('id', 1)->first();
    echo "<p> Depois da atualização </p>";
    echo "id: " . $cat->id . "; ";
    echo "nome: " . $cat->nome . "<br> ";
});

Route::get('/removendocategorias', function(){ //DELETE
    
    echo "<p> Antes da remoção </p>";
    
    $cats = DB::table('categorias')->get();
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";

    //DB::table('categorias')->where('id', 1)->delete();
    DB::table('categorias')->whereNotIn('id', [1,2,3,4,5,6])->delete();
    
    echo "<p> Depois da atualização </p>";
    $cats = DB::table('categorias')->get();
    foreach($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }
});

//ELOQUENT / ORM

Route::get('/inserir/{nome}', function($nome){
    $cat = new Categoria();
    $cat->nome = $nome;
    $cat->save();

    return redirect('listartodos');
});

Route::get('/listartodos', function(){
    $categorias = Categoria::all();
    foreach($categorias as $c){
        echo "id: " . $c->id . ", ";
        echo "nome: " . $c->nome . "<br>";

    }
});

Route::get('/categoria/{id}', function($id){
    //$cat = Categoria::find($id);
    $cat = Categoria::findOrFail($id);
    if(isset($cat)){
        echo "id: " . $cat->id . ", ";
        echo "nome: " . $cat->nome . "<br>";
    }
    else{
        echo "<h1> Categoria não encontrada!</h1>";
    }
});

Route::get('/atualizar/{id}/{nome}', function($id, $nome){
    
    $cat = Categoria::find($id);
    if(isset($cat)){
        $cat->nome = $nome;
        $cat->save();

        return redirect('listartodos');
    }
    else{
        echo "<h1> Categoria não encontrada!</h1>";
    }
});

Route::get('/remover/{id}', function($id){
    
    $cat = Categoria::find($id);
    if(isset($cat)){
        $cat->delete();

        return redirect('listartodos');
    }
    else{
        echo "<h1> Categoria não encontrada!</h1>";
    }
});

Route::get('/categoriapornome/{nome}', function($nome){
    
    $categorias = Categoria::where('nome', $nome)->get();
    foreach($categorias as $c){
        echo "id: " . $c->id . ", ";
        echo "nome: " . $c->nome . "<br>";

    }
});

Route::get('/categoriaidmaiorque/{id}', function($id){
    
    $categorias = Categoria::where('id', '>' ,$id)->get();
    foreach($categorias as $c){
        echo "id: " . $c->id . ", ";
        echo "nome: " . $c->nome . "<br>";

    }

    $count = Categoria::where('id', '>' ,$id)->count();
    echo "<h1> Count: $count </h1>";

    $max = Categoria::where('id', '>' ,$id)->max('id');
    echo "<h1> Max: $max </h1>";
});

Route::get('/ids121314', function(){
    
    $categorias = Categoria::find([12, 13, 14]);
    foreach($categorias as $c){
        echo "id: " . $c->id . ", ";
        echo "nome: " . $c->nome . "<br>";

    }
});

Route::get('/todas', function(){ //Listar todos os dados, até os apagados com softDeletes
    $categorias = Categoria::withTrashed()->get();
    foreach($categorias as $c){
        echo "id: " . $c->id . ", ";
        echo "nome: " . $c->nome;

        if($c->trashed()) //função boolean
            echo '(apagado)<br>';
        else
            echo '<br>';

    }
});

Route::get('/ver/{id}', function($id){ // mostra os dados que foram apagados(Soft Deletes)
    
    //$cat = Categoria::withTrashed()->find($id);

    $cat = Categoria::withTrashed()->where('id', $id)->get()->first();
    if(isset($cat)){
        echo "id: " . $cat->id . ", ";
        echo "nome: " . $cat->nome . "<br>";
    }
    else{
        echo "<h1> Categoria não encontrada!</h1>";
    }
});

Route::get('/somenteapagadas', function(){ //Listar todos os dados, até os apagados com softDeletes
    $categorias = Categoria::onlyTrashed()->get();
    foreach($categorias as $c){
        echo "id: " . $c->id . ", ";
        echo "nome: " . $c->nome;

        if($c->trashed()) //função boolean
            echo '(apagado)<br>';
        else
            echo '<br>';

    }
});

Route::get('/restaurar/{id}', function($id){ // mostra os dados que foram apagados(Soft Deletes)
    
    $cat = Categoria::withTrashed()->find($id);

    if(isset($cat)){
        $cat->restore(); //restaura dados apagados(Soft Deletes)
        echo "Categoria Restaurada: " . $cat->id . "<br>";
        echo "<a href =\"/listartodos\"> Listar todas </a> ";
    }
    else{
        echo "<h1> Categoria não encontrada!</h1>";
    }
});

Route::get('/apagarpermanente/{id}', function($id){ // mostra os dados que foram apagados(Soft Deletes)
    
    $cat = Categoria::withTrashed()->find($id);

    if(isset($cat)){
        $cat->forceDelete(); //restaura dados apagados(Soft Deletes)
        
        return redirect('/todas');
    }
    else{
        echo "<h1> Categoria não encontrada!</h1>";
    }
});

//VALIDAÇÃO DE FORMULÁRIOS

Route::get('/novocliente', 'ClienteControlador@create');

Route::get('/clientes', 'ClienteControlador@index');

Route::post('/cliente', 'ClienteControlador@store');

// CATEGORIA E SEUS PRODUTOS

Route::get('/', function () {
    return view('index');
});

Route::get('/produtos', 'ControladorProduto@indexView');

Route::get('/categorias', 'ControladorCategoria@index');

Route::get('/categorias/novo', 'ControladorCategoria@create');

Route::post('/categorias', 'ControladorCategoria@store');

Route::get('/categorias/apagar/{id}', 'ControladorCategoria@destroy');

Route::get('/categorias/editar/{id}', 'ControladorCategoria@edit');

Route::post('/categorias/{id}', 'ControladorCategoria@update');

Route::get('/produtos/novo', 'ControladorProduto@create');

Route::post('/produtos', 'ControladorProduto@store');

Route::get('/produtos/apagar/{id}', 'ControladorProduto@destroy');

Route::get('/produtos/editar/{id}', 'ControladorProduto@edit');

Route::post('/produtos/{id}', 'ControladorProduto@update');

//ELOQUENTE ORM - RELACIONAMENTOS UM PRA UM

Route::get('/clientes', function (){
    $clientes = Cliente::all();
    foreach($clientes as $c){
        echo "<p>ID: ". $c->id. "</p>";
        echo "<p>Nome: ". $c->nome ."</p>";
        echo "<p>Telefone: ". $c->telefone ."</p>";
       // $e = Endereco::where('cliente_id', $c->id)->first();
        echo "<p>Rua: ". $c->endereco->rua ."</p>";
        echo "<p>Numero: ". $c->endereco->numero ."</p>";
        echo "<p>Bairro: ". $c->endereco->bairro ."</p>";
        echo "<p>Cidade: ". $c->endereco->cidade ."</p>";
        echo "<p>UF: ". $c->endereco->uf ."</p>";
        echo "<p>CEP: ". $c->endereco->cep ."</p>";
        echo "<hr>";

    }

});

Route::get('/enderecos', function (){
    $ends = Endereco::all();
    foreach($ends as $e){
        echo "<p>ID: ". $e->cliente_id. "</p>";
        echo "<p>Nome: ". $e->cliente->nome ."</p>";
        echo "<p>Telefone: ". $e->cliente->telefone ."</p>";
        echo "<p>Rua: ". $e->rua ."</p>";
        echo "<p>Numero: ". $e->numero ."</p>";
        echo "<p>Bairro: ". $e->bairro ."</p>";
        echo "<p>Cidade: ". $e->cidade ."</p>";
        echo "<p>UF: ". $e->uf ."</p>";
        echo "<p>CEP: ". $e->cep ."</p>";
        echo "<hr>";

    }

});

Route::get('inserir', function(){
    $c = new Cliente();
    $c->nome = "Jose Almeida";
    $c->telefone = "11 97979-9797";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Estado";
    $e->numero = 400;
    $e->bairro = "Centro";
    $e->cidade = "Sao Paulo";
    $e->uf = "SP";
    $e->cep = "13010-456";
    //$e->cliente_id = $c->id;

    $c->endereco()->save($e);

    $c = new Cliente();
    $c->nome = "Marcos Silva";
    $c->telefone = "11 98787-8787";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Brasil";
    $e->numero = 1500;
    $e->bairro = "Jardim Oliveira";
    $e->cidade = "Sao Paulo";
    $e->uf = "SP";
    $e->cep = "13222-456";
    //$e->cliente_id = $c->id;

    $c->endereco()->save($e);

});

Route::get('/clientes/json', function(){
    //$clientes = Cliente::all(); //Lazy Loading
    $clientes = Cliente::with(['endereco'])->get(); //Eager Loading
    return $clientes->toJson();

});

Route::get('/enderecos/json', function(){
  //  $enderecos = Endereco::all(); //Lazy Loading
    $enderecos = Endereco::with(['cliente'])->get(); //Eager Loading
    return $enderecos->toJson();

});