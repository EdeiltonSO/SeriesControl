<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index(Request $req) {

        // $series = Serie::all(); // ordem de criação
        $series = Serie::query()->orderBy('nome')->get(); // ordem alfabética

        $mensagem = $req->session()->get('mensagem');

        // $req->session()->remove('mensagem');

        // return view('series.index', compact('series'));
        return view('series.index', [ 'series' => $series, 'mensagem' => $mensagem ]);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $req)
    {
        /* $serie = Serie::create([
            'nome' => $req->nome
        ]); */
        $serie = Serie::create($req->all());

        // por que isso nao funciona aqui?
        // var_dump($serie);
        // echo "ALO";
        // echo "<script>console.log('ALO???');</script>";

        // de onde vem esse $serie->id, já que ele aparece
        // mesmo que eu não crie um campo id na migration?
        // (conferir laravel parte 1, seção 5, session e flash messages)

        $req->session()->flash('mensagem', "Série {$serie->nome} com id {$serie->id} adicionada com sucesso");

        return redirect()->route('listar_series');
    }

    public function destroy(Request $req)
    {
        Serie::destroy($req->id);

        $req->session()->flash('mensagem', "Série removida com sucesso");

        return redirect()->route('listar_series');
    }
}
