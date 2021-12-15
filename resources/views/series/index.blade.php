@extends('layout')

@section('cabecalho')
Lista de séries
@endsection

@section('conteudo')

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>

<ul class="list-group">
    @foreach($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

            <div class="input-group w-50 align-items-center" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-info btn-sm" onclick="editarSerie({{ $serie->id }})">
                        <i class="lni lni-checkmark"></i>
                    </button>
                    @csrf
                </div>
            </div>

            <span class="d-flex">
                <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                    <i class="lni lni-pencil-alt"></i>
                </button>
                <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                    <i class="lni lni-link"></i>
                </a>
                <form action="/series/{{ $serie->id }}" method="post" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="lni lni-trash-can"></i></button>
                </form>
            </span>
        </li>
    @endforeach
</ul>
<script>
    function toggleInput(serieId) {
        const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);

        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }
    }

    function editarSerie(serieId) {
        let formData = new FormData();

        const name = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
        const token = document.querySelector(`input[name="_token"]`).value;

        formData.append('name', name);
        formData.append('_token', token);

        const url = `/series/${serieId}/editaNome`;

        fetch(url, {
            body: formData,
            method: 'POST'
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = name;
        });
    }
</script>
@endsection
