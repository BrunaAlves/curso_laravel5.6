<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    protected $table = 'desenvolvedores';

    function projetos(){
        return $this->belongsToMany("App\Projeto", "alocacoes"); //O desenvolvedor possui varios projetos a partir da tabela de alocações
    }
}
