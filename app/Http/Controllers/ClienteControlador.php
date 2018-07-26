<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;

class ClienteControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // lista
    {
        $clientes = Cliente::all();
        return view('cliente', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Mostra o formulário de criar
    {
        return view('novocliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //Recebe os dados criados e adiciona. request de algum modo envia um metodo e recebe os dados.
    {
        $request->validate([
            'nome' => 'required|min:3|max:20|unique:clientes',
            
        ]);

       $cliente = new Cliente();
       $cliente->nome = $request->input('nome');
       $cliente->idade = $request->input('idade');
       $cliente->endereco = $request->input('endereco');
       $cliente->email = $request->input('email');
       $cliente->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Mostrar informações através do seu ID
    {
        $v = ["Mario", "Edson", "Roberto", "Jean"]; //array
        if($id >= 0 && $id < count($v))
            return $v[$id]; // retorna o nome, conforme a posição do array(nesse caso o id é visto como a posição do array);
        return "Não encontrado";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //Mostra o formulário de Editar 
    {
        return "Formulário para Editar Cliente com ID " .$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Ao clicar em salvar, esse metodo recebe as informações editadas e salva
    {
        $s = "Atualizar Cliente com id $id: ";
        $s .= "Nome: " . $request->input('nome') . " e "; //Espera receber um dos input com o name "nome"
        $s .= "Idade: " . $request->input('idade');
        return response($s, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //Excluir através do id
    {
        return response("Apagado cliente com id $id", 200);
    }

    public function requisitar(Request $request){
        echo "nome: " . $request->input('nome');
    }
}
