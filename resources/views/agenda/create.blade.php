@extends('layout')
@section('cabecalho')
    Adicionar Contato
@endsection

@section('conteudo')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>



    <form action="/agenda/criar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-10">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>

    {{--            <div class="col col-3">--}}
    {{--            <label for="nome">Foto de perfil</label>--}}
    {{--            <input type="file" class="form-control" name="capa" id="capa">--}}
    {{--        </div>--}}

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="E-mail">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label for="Telefone">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" placeholder="telefone">
                </div>

            <div class="form-group col-md-4">
                <label for="CEP">CEP</label>
                <input name="cep" type="text" id="cep" class="form-control"  value="" size="10" maxlength="9" required>
            </div>

            <div class="form-group col-md-5">
                <label for="rua">Rua</label>
                <input name="rua" type="text" id="rua" class="form-control" size="60"required>
            </div>

            <div class="form-group col-md-6">
                <label for="bairro">Bairro</label>
                <input name="bairro" type="text" id="bairro" class="form-control" size="40"required>
            </div>

            <div class="form-group col-md-3">
                <label for="cidade">Cidade</label>
                <input name="cidade" id="cidade" class="form-control" size="2"required>
            </div>

             <div class="form-group col-md-3">
               <label for="estado">Estado</label>
             <input name="estado" id="uf" class="form-control"required>
                </div>

            </div>

            <button class="btn btn-primary" type="submit">Adicionar</button>
    </form>
@endsection
