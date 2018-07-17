<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuControlador extends Controller
{
    public function getNome(){
        return "Bruna Alves";
    }

    public function getIdade(){
        return "23 anos";
    }

    public function multiplicar($n1, $n2){ //recebe os dois valores passado na rota
        return $n1*$n2;
    }

    public function getNomeByID($id){ //recebe o id passado na rota
        $v = ["Mario", "Edson", "Roberto", "Jean"]; //array
        if($id >= 0 && $id < count($v))
            return $v[$id]; // retorna o nome, conforme a posição do array(nesse caso o id é visto como a posição do array);
        return "Não encontrado";

    }
}
