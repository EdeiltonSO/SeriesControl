@extends('layout')

@section('cabecalho')
    Temporadas da série {{ $serie->nome }}
@endsection

@section('conteudo')
    <ul>
        @foreach ($temporadas as $temporada)
            <li class="list-group-item">Temporada {{ $temporada->numero }}</li>
        @endforeach
    </ul>
@endsection
