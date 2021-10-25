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

    <script>

        'use strict';

        const limparFormulario = (endereco) =>{
            document.getElementById('endereco').value = '';
            document.getElementById('bairro').value = '';
            document.getElementById('cidade').value = '';
            document.getElementById('estado').value = '';
        }


        const preencherFormulario = (endereco) =>{
            document.getElementById('endereco').value = endereco.logradouro;
            document.getElementById('bairro').value = endereco.bairro;
            document.getElementById('cidade').value = endereco.localidade;
            document.getElementById('estado').value = endereco.uf;
        }


        const eNumero = (numero) => /^[0-9]+$/.test(numero);

        const cepValido = (cep) => cep.length == 8 && eNumero(cep);

        const pesquisarCep = async() => {
            limparFormulario();

            const cep = document.getElementById('cep').value;
            const url = `https://viacep.com.br/ws/${cep}/json/`;
            if (cepValido(cep)){
                const dados = await fetch(url);
                const endereco = await dados.json();
                if (endereco.hasOwnProperty('erro')){
                    document.getElementById('endereco').value = 'CEP não encontrado!';
                }else {
                    preencherFormulario(endereco);
                }
            }else{
                document.getElementById('endereco').value = 'CEP incorreto!';
            }

        }

        document.getElementById('cep')
            .addEventListener('focusout',pesquisarCep);

    </script>

    <form action="/agenda/criar" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Selecione a foto:</label>
            <input type="file"  name="photo" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="E-mail">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
                <label for="Telefone">Telefone</label>
                <input type="text" class="form-control" name="telefone" id="Telefone" placeholder="Telefone">
            </div>

        <div class="form-group col-md-2">
            <label for="CEP">CEP</label>
            <input type="text" class="form-control" name="cep" id="cep" value="" size="10" maxlength="9">
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" class="form-control" name="endereco" id="endereco" size="60">
        </div>

        <div class="form-group">
            <label for="numero">Número</label>
            <input type="text" class="form-control" name="numero" id="numero" size="40">
        </div>

        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" name="bairro" id="bairro" size="40">
        </div>

        <div class="form-group col-md-4">
            <label for="cidade">Cidade</label>
            <input name="cidade" id="cidade" class="form-control" size="2">
        </div>

         <div class="form-group col-md-4">
           <label for="estado">Estado</label>
         <input name="estado" id="estado" class="form-control">
            </div>

        </div>

        <button class="btn btn-primary" type="submit">Adicionar</button>
    </form>
@endsection
