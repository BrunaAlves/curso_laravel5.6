<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //Quando quero executar uma migração, respeitando a linha temporal(timestamp ao criar a migration)
    {
        Schema::create('produtos', function (Blueprint $table) { //é a classe que vai ser utilizada e contem todos os metodos para criação, remoção e manutenção das tabelas do banco de dados
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // Reverter as informações que foram feitos no up, respeitando do mais novo ao mais antigo(de acordo com o timestamp no nome da migration)
    {
        Schema::dropIfExists('produtos');
    }
}
