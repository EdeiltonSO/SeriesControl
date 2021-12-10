<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\{ Serie, Temporada, Episodio };

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

    public function store(SeriesFormRequest $req)
    {
        //dd($req);
        $serie = Serie::create(['nome' => $req->nome]);
        $qtdTemporadas = $req->qtd_temporadas;
        $epPorTemporada = $req->ep_por_temporada;

        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ($j = 1; $j <= $epPorTemporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        $req->session()
            ->flash(
                'mensagem',
                "Série {$serie->nome} (com id {$serie->id} e suas temporadas e episódios) adicionada com sucesso"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $req)
    {
        //dd($req->id);

        /*
        A linha abaixo apaga uma série pelo id,
        mas uma série tem várias temporadas
        e cada temporada tem vários episódios.

        Como informar que quero apagar todos os
        registros de temporadas e episódios
        de uma série quando eu apagar ela?

        keywords: cascade, cascata
        */

        Serie::destroy($req->id);

        $req->session()->flash('mensagem', "Série removida com sucesso");

        return redirect()->route('listar_series');
    }
}
