<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioControlador extends Controller
{
    public function __construct(){
       // $this->middleware('primeiro');
    }
    public function index(){
        return '<h3>Lista de usuários</h3>' .
         '<ul>'.
         '<li>João</li>' .
         '<li>Maria</li>' .
         '<li>José</li>' .
         '<li>Marcos</li>' .
         '</ul>';

    }
}
