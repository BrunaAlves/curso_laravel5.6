<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
  //  private $produtos = ["Televisao 40", "Notebook Acer", "Impressora HP", "HD Externo"];

    public function __construct(){
       // $this->middleware(\App\Http\Middleware\ProdutoAdmin::Class);
       $this->middleware('auth');
    }
    public function index(){
        /*
        echo "<h3>Produtos</h3>";
        echo "<ol>";
        foreach($this->produtos as $p){
            echo "<li>" .$p . "</li>";
        }
        echo "</ol>";
        */

        echo "<h4>Lista de Produtos</h4>";
        echo "<ul>";
        echo "<li>Macarrão</li>";
        echo "<li>Feijão</li>";
        echo "<li>Carne Bovina</li>";
        echo "<li>Arroz</li>";
        echo "<li>Leite</li>";
        echo "</ul>";
    }
}
