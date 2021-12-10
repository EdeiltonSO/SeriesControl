<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\{ Serie, Temporada, Episodio };
use App\Services\SeriesCreator;

class SeriesController extends Controller
{
    public function index(Request $req) {

        // $series = Serie::all(); // ordem de criação
        $series = Serie::query()->orderBy('nome')->get(); // ordem alfabética

        $mensagem = $req->session()->get('mensagem');
        //dd($series);
        return view('series.index', [ 'series' => $series, 'mensagem' => $mensagem ]);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $req, SeriesCreator $seriesCreator)
    {
        //dd($req);
        $serie = $seriesCreator
            ->criaSerie(
                $req->nome,
                $req->qtd_temporadas,
                $req->ep_por_temporada
            );

        $req->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} (com id {$serie->id} e suas temporadas e episódios) adicionada com sucesso"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $req)
    {
        // encontrando série no banco
        $serie = Serie::find($req->id);
        $nomeSerie = $serie->nome;
        // excluindo relações com temporada e episódio
        $serie->temporadas->each(function (Temporada $temporada) {
            $temporada->episodios->each(function (Episodio $episodio) {
                $episodio->delete();
            });
            $temporada->delete();
        });
        $serie->delete();

        // Serie::destroy($req->id);
        $req->session()->flash('mensagem', "Série $nomeSerie removida com sucesso");
        return redirect()->route('listar_series');
    }
}
