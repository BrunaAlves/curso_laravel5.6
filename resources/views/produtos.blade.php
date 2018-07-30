@extends('layout.app', ["current" => "produtos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>
                <table class="table table-ordered table-hover" id="tabelaProdutos">
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
                </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onClick="novoProduto()">Novo produto</a>
        </div>
    </div>

<div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formProduto">
            @csrf
                <div class="modal-header">
                    <h5 class="modal-title"> Novo produto</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeProduto" class="control-label"> Nome do Produto</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do Produto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precoProduto" class="control-label"> Preço</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="precoProduto" placeholder="Preço do Produto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label"> Quantidade</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="quantidadeProduto" placeholder="Quantidade do Produto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoriaProduto" class="control-label"> Nome da categoria</label>
                        <div class="input-group">
                            <select class="form-control" id="categoriaProduto">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dissmiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function novoProduto(){
            $('#id').val('');
            $('#nomeProduto').val('');
            $('#precoProduto').val('');
            $('#quantidadeProduto').val('');
            $('#dlgProdutos').modal('show');
        }

        function carregarCategorias() {
            $.getJSON('/api/categorias', function(data){
               // console.log(data);
                for(i=0;i<data.length;i++){
                    opcao = '<option value ="' + data[i].id + '">' + data[i].nome + '</option>';
                    $('#categoriaProduto').append(opcao);
                }
            });
        }
        
        function montarLinha(p){
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + p.nome + "</td>" +
                "<td>" + p.estoque + "</td>" +
                "<td>" + p.preco + "</td>" +
                "<td>" + p.categoria_id + "</td>" +
                "<td>" +
                 '<button class="btn btn-sm btn-primary"> Editar </button> ' +
                 '<button class="btn btn-sm btn-danger"> Apagar </button> ' +
                "</td>" +
                "<tr>";
            return linha;
        }

        function carregarProdutos() {
            $.getJSON('/api/produtos', function(produtos){
               // console.log(data);
                for(i=0;i<produtos.length;i++){
                    linha = montarLinha(produtos[i]);
                    $('#tabelaProdutos>tbody').append(linha);
                }
            });
        }

        $(function(){
            carregarCategorias();
            carregarProdutos();
        })
    </script>
@endsection