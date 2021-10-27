@extends('layout')
@section('cabecalho')
    Agenda telefonica
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
                <span class="d-flex">
                    <a  href="/agenda/{{$agenda->id}}/edit"  class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    <form method="post" action="/agenda/{{ $agenda->id }}"
                          onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $agenda->nome )}}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="far fa-trash-alt"></i>
                    </form>
                 </span>
            </li>

        @endforeach
    </ul>
@endsection
