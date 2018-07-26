@extends('layout.app', ["current" => "produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/produtos/{{ $prod->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do produto</label>
                    <input type="text" class="form-control" name="nomeProduto" value="{{ $prod->nome}}" id="nomeProduto" placeholder="Produto">
                    <label for="nomeProduto">Qtd Estoque</label>
                    <input type="text" class="form-control" name="estoque" value="{{ $prod->estoque}}" id="nomeProduto" placeholder="Estoque">
                    <label for="nomeProduto">Nome do produto</label>
                    <input type="text" class="form-control" name="preco" value="{{ $prod->preco}}" id="preco" placeholder="Preço">
                    <label for="nomeProduto">Categoria</label>
                    <input type="text" class="form-control" name="categoria" value="{{ $prod->categoria_id}}" id="categoria" placeholder="Categoria">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>
@endsection