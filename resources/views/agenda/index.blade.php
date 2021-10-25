@extends('layout')
@section('cabecalho')
    Agenda
@endsection

@section('conteudo')
    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif

    <a href="/agenda/criar" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach($agenda as $agenda)
            <li class="list-group-item d-flex justify-content-between align-content-lg-center">
                {{ $agenda->nome }}
                <form method="post" action="/agenda/{{ $agenda->id }}"
                      onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $agenda->nome )}}?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i>
                </form>
            </li>

        @endforeach
    </ul>
@endsection
