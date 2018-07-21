<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    public function listar(){
        $produtos = [
            "Notebook Asus i7 16GB",
            "Mouse e Teclado Microsoft USB",
            "Monitor 21 - Samsung",
            "Impressora HP",
            "Disco SSD 512 GB"
        ];

        return view('produtos', compact('produtos'));
    }

    public function secaoprodutos($palavra){
        return view('secao_produtos', compact('palavra'));
    }

    public function mostrar_opcoes(){

        return view('mostrar_opcoes');
    }

    public function opcoes($opcao){
        return view('opcoes', compact('opcao'));
    }
}
