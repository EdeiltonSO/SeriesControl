@extends('layout')

@section('cabecalho')
Adicionar série
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

<form method="post">
    @csrf
    <div class="form-group">
        <label for="nome" class="mb-2">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control mb-2">
    </div>
    <button class="btn btn-primary">Adicionar</button>
</form>
@endsection
