@extends('layout.app', ["current" => "produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>

                <table class="table table-ordered table-hover">
                    <thread>
                        <tr>
                            <th>Código</th>
                            <th>Nome do Produto</th>
                            <th>Qtd Estoque</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thread>
                    <tbody>
                            <tr>
                            
                            </tr>
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button">Novo produto</a>
        </div>
    </div>

@endsection